<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use App\Mail\RememberPassword;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class User extends Model
{
    use HasFactory;

    public function scopeSoftDelete($query)
    {
        return $query->whereNull('deleted_at');
    }

    public function login($request)
    {
        $user = User::softDelete()
            ->where('email', $request->email)
            ->first();
        if (empty($user)) {
            session()->flash('message', 'Địa chỉ email hoặc mật khẩu không chính xác');
            return false;
        } else {
            if (Hash::check($request->password, $user->password)) {
                session(['id' => $user->id]);
                return true;
            }
            session()->flash('message', 'Địa chỉ email hoặc mật khẩu không chính xác');
            return false;
        }
    }

    public function register($request)
    {
        $user = new User();
        $user->email = $request->email;
        $user->userName = $request->userName;
        $user->address = $request->address;
        $user->password = bcrypt($request->password);
        $user->save();
        session()->flash('message', 'Đăng kí tài khoản thành công!');
    }

    public function getAllUsers()
    {
        return User::softDelete()->orderBy('updated_at', 'DESC')->paginate(6);
    }

    public function getUser($id)
    {
        return User::find($id);
    }

    public function updateUser($request, $id)
    {
        $user = User::find($id);
        $path = null;
        if ($request->file('avatar') != null) {
            $path = $request->file('avatar')->store('public');
        }
        if ($path != null) {
            $user->avatar = $path;
        }
        $user->userName = $request->userName;
        $user->address = $request->address;
        $user->save();
        session()->flash('message', 'Cập nhật thông tin thành công!');
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        $user->deleted_at = now();
        if ($user->avatar != null) {
            Storage::delete($user->avatar);
            $user->avatar = null;
        }
        $user->save();
        session()->flash('message', 'Xóa thông tin thành công!');
    }

    public function updatePassword($request)
    {
        $user = User::find(session('id'));
        $user->password = bcrypt($request->password);
        $user->save();
        session()->flash('message', 'Thay đổi mật khẩu thành công!');
    }

    public function createToken($request)
    {
        $user = User::where('email', $request->email)->softDelete()->first();
        if (!empty($user)) {
            $token = random_int(100000, 999999);
            $user->reset_password_token = $token;
            $user->expired_time = now()->addMinutes(10);
            $user->save();
            $mess = "Mã xác thực quên mật khẩu của bạn là $token. Mã này có hiệu lực trong 10 phút.";
            Mail::to($request->email)->send(new RememberPassword($mess));
        }
    }

    public function resetPassword($request, $email)
    {
        $user = User::where('email', $email)->softDelete()->first();
        if (!empty($user)) {
            if ($user->reset_password_token == $request->reset_password_token && $user->expired_time >= now()) {
                $newPassword = Str::random(6);
                $user->password = bcrypt($newPassword);
                $user->expired_time = now();
                $user->save();
                $mess = "Mật khẩu của bạn là: $newPassword. Vui lòng bảo mật thông tin này.";
                Mail::to($request->email)->send(new RememberPassword($mess));
                session()->flash('message', 'Mật khẩu đã được gửi tới email của bạn.');
            } else {
                session()->flash('message', 'Mã xác thực không chính xác hoặc đã hết hạn.');
            }
        }
    }
}
