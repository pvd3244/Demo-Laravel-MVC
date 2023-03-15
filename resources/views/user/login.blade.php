@extends('layout.app')
@section('content')
    <div class="container">
        <div class="form">
            <form method="POST" action="{{route('users.login')}}">
                @csrf
                @method('POST')
                <h2 class="text-primary" align="center">Đăng nhập hệ thống</h2>
                <div class="form-group">
                    <label for="email">Địa chỉ email:</label>
                    <input type="text" class="form-control" placeholder="Nhập địa chỉ email" name="email" value="{{old('email')}}">
                    @error('email')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="pwd">Mật khẩu:</label>
                    <input type="password" class="form-control" placeholder="Nhập mật khẩu" name="password">
                    @error('password')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="submit" value="Đăng nhập" class="btn btn-primary btn-block">
                    @if(session()->has('message'))
                        <p class="text-danger">{{session('message')}}</p>
                    @endif
                </div>
                <div class="form-group">
                    <a href="{{route('user.remember')}}">Quên mật khẩu</a>
                </div>
            </form>
        </div>
    </div>
@endsection
