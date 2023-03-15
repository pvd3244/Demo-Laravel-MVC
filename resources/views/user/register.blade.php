@extends('layout.app')
@section('content')
    <div class="container">
        <div class="form">
            <form method="POST" action="{{route('users.store')}}">
                @csrf
                @method('POST')
                <h2 class="text-primary" align="center">Đăng kí tài khoản</h2>
                <div class="form-group">
                    <label for="email">Địa chỉ email:</label>
                    <input type="text" class="form-control {{$errors->has('email') ? 'input-error' : ''}}" placeholder="Nhập địa chỉ email" name="email" value="{{old('email')}}">
                    @error('email')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="userName">Tên người dùng:</label>
                    <input type="text" class="form-control {{$errors->has('userName') ? 'input-error' : ''}}" placeholder="Tên người dùng" name="userName" value="{{old('userName')}}">
                    @error('userName')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="address">Nhập địa chỉ:</label>
                    <input type="text" class="form-control {{$errors->has('address') ? 'input-error' : ''}}" placeholder="Nhập địa chỉ" name="address" value="{{old('address')}}">
                    @error('address')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Mật khẩu:</label>
                    <input type="password" class="form-control {{$errors->has('password') ? 'input-error' : ''}}" placeholder="Mật khẩu" name="password">
                    @error('password')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Xác nhận mật khẩu:</label>
                    <input type="password" class="form-control {{$errors->has('password_confirmation') ? 'input-error' : ''}}" placeholder="Xác nhận mật khẩu" name="password_confirmation">
                    @error('password_confirmation')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group float-sm-right">
                    <input type="submit" value="Hoàn tất" class="btn btn-primary">
                    <a class="btn btn-danger" href="{{route('users.index')}}">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection
