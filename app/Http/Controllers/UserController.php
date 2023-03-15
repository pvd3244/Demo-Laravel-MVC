<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RememberEmailRequest;
use App\Http\Requests\RememberTokenRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = app('user')->getAllUsers();
        return view('user.index', ['users' => $users]);
    }

    //Login
    public function login(LoginRequest $request)
    {
        if (app('user')->login($request)) {
            return redirect()->route('users.index');
        }
        return redirect()->back()->withInput();
    }

    //Logout
    public function logout()
    {
        session()->forget('id');
        return redirect(route('user.login'));
    }

    //Profile
    public function profile($id)
    {
        $data = app('user')->getUser($id);
        return view('user.profile', ['user' => $data]);
    }

    //Update password
    public function updatePassword(UpdatePasswordRequest $request)
    {
        app('user')->updatePassword($request);
        return redirect()->route('users.index');
    }

    //Create token
    public function createToken(RememberEmailRequest $request)
    {  
        app('user')->createToken($request);
        return redirect()->route('user.token', $request->email);
    }

    //Reset password
    public function resetPassword(RememberTokenRequest $request, $email)
    {    
        app('user')->resetPassword($request, $email);
        return redirect()->route('user.token', $email);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        app('user')->register($request);
        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = app('user')->getUser($id);
        return view('user.edit', ['user' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        app('user')->updateUser($request, $id);
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        app('user')->deleteUser($id);
        return redirect()->route('users.index');
    }
}
