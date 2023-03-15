<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'password' => 'required|min:5',
            'password_confirmation' => 'required_with:password|same:password'
        ];
    }

    public function attributes()
    {
        return [
            'password' => 'mật khẩu',
            'password_confirmation' => 'xác nhận mật khẩu'
        ];

    }
}
