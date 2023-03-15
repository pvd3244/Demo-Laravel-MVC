@extends('layout.app')
@section('content')
    <div class="container">
        <div class="form">
            <form action="{{route('users.update', $user->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <h2 class="text-primary" align="center">Sửa thông tin tài khoản</h2>
                <div class="form-group">
                    <label for="avatar">Ảnh đại diện:</label><br>
                    <input type="file" name="avatar">
                    @error('avatar')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="userName">Tên người dùng:</label>
                    <input type="text" class="form-control" placeholder="Tên người dùng" name="userName" value="{{old('userName') ? old('userName') : $user->userName}}">
                    @error('userName')
                        <p class="text-danger">{{$message}}</p>
                     @enderror
                </div>
                <div class="form-group">
                    <label for="address">Địa chỉ:</label>
                    <input type="text" class="form-control" placeholder="Nhập địa chỉ" name="address" value="{{old('address') ? old('address') : $user->address}}">
                    @error('address')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group float-sm-right">
                    <input type="submit" value="Hoàn tất" class="btn btn-primary">
                    <a href="{{route('users.index')}}" class="btn btn-danger">Hủy</a>
                </div>
            </form>
        </div>
    </div>
@endsection
