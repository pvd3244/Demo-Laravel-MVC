@extends('layout.app')
@section('content')
    <form method="POST" action="{{route('user.logout')}}">
        @csrf
        @method('POST')
        <div class="float-right">
            <a href="{{route('user.profile', session('id'))}}">Thông tin cá nhân</a>
            <input type="submit" value="Đăng xuất" class="btn btn-danger">
        </div>
        <a href="{{route('users.create')}}" class="btn btn-primary">Đăng kí</a>
    </form>
    @if(session()->has('message'))
        <p class="text-success">{{session('message')}}</p>
    @endif
    <table class="table table-striped">
        <h1 class="text-primary" align="center">Danh sách người dùng</h1>
        <thead>
            <tr>
                <th>STT</th>
                <th>Ảnh đại diện</th>
                <th>Email</th>
                <th>Tên người dùng</th>
                <th>Địa chỉ</th>
                <th>Chức năng</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{$loop->index + 1}}</td>
                    @if($user->avatar == null)
                        <td><img src="avatar.jpg" width="40px" height="40px"></td>
                    @else
                        <td><img src="{{Storage::url($user->avatar)}}" width="40px" height="40px"></td>
                    @endif
                    <td>{{$user->email}}</td>
                    <td>{{$user->userName}}</td>
                    <td>{{$user->address}}</td>
                    <td>
                        <form method="POST" action="{{route('users.destroy', $user->id)}}">
                            @csrf
                            @method('DELETE')
                            <a href="{{route('users.edit', $user->id)}}" class="btn btn-primary">Sửa</a>
                            <input type="submit" value="Xóa" class="btn btn-danger">
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div style="display: flex; justify-content: center;">
        {{$users->links('pagination::bootstrap-4')}}
    </div>
@endsection
