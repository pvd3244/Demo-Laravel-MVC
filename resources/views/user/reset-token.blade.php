@extends('layout.app')
@section('content')
    <div class="container">
        <div class="form">
            <form method="POST" action="#">
                @csrf
                @method('POST')
                <h2 class="text-primary" align="center">Quên mật khẩu</h2>
                <div class="form-group">
                    <label for="reset_password_token">Nhập mã xác thực:</label>
                    <input type="text" class="form-control" placeholder="Nhập mã xác thực" name="reset_password_token" value="{{old('reset_password_token')}}">
                    @error('reset_password_token')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                    @if(session()->has('message'))
                        <p class="text-danger">{{session('message')}}</p>
                    @endif
                </div>
                <div class="form-group float-right">
                    <input type="submit" value="Lấy mật khẩu" class="btn btn-primary">
                    <a href="{{route('user.login')}}" class="btn btn-danger">Về trang đăng nhập</a>
                </div>
            </form>
        </div>
    </div>
@endsection
