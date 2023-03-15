@extends('layout.app')
@section('content')
    <div class="container">
        <div class="form">
            <form method="POST" action="#">
                @csrf
                @method('POST')
                <h2 class="text-primary" align="center">Quên mật khẩu</h2>
                <div class="form-group">
                    <label for="email">Địa chỉ email:</label>
                    <input type="text" class="form-control" placeholder="Nhập địa chỉ email" name="email" value="{{old('email')}}">
                    @error('email')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group float-right">
                    <input type="submit" value="Gửi mã xác thực" class="btn btn-primary">
                    <a href="{{route('user.login')}}" class="btn btn-danger">Quay lại</a>
                </div>
            </form>
        </div>
    </div>
@endsection
