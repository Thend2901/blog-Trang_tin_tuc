<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blog của tôi</title>
</head>
<body>
    <h1>Blog của tôi</h1>
    @auth
    <h2>Chào mừng <span style="color: blue">{{$user->name}}</span> đã đăng nhập </h2>
    <a href="/logout">Đăng xuất</a>
    <h2>Tạo bài viết</h2>
    <form action="/creat-post" method="post">
        @csrf
        <input type="text" name="title" placeholder="Tiêu đề bài viết" >
        <textarea name="body" cols="30" rows="10" placeholder="Nội dung bài viết">{{old('body')}}</textarea>
        <button>Tạo bài viết</button>
    @else 
    <div style="border: 3px solid black; padding: 10px">
        <h2>Đăng ký</h2>
        <form action="/register" method="post">
            @csrf
            <input type="text" placeholder="Nhập Tên đăng nhập" name="name" value="{{old('name')}}">
            <input type="email" placeholder="Nhập email của bạn" name="email" value="{{old('email')}}">
            <input type="password" placeholder="Mật khẩu" name="password">
            <input type="password" placeholder="Nhắc lại mật khẩu " name="password_confirmation">
            <button>Đăng ký</button>
        </form>
        @if($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li style="color:red">{{ $error }}</li>
                    
                @endforeach
            </ul>
        @endif
    </div>
    <div style="border: 3px solid black; padding: 10px">
        <h2>Đăng nhập </h2>
        <form action="/login" method="post">
            @csrf
            <input type="email" placeholder="Nhập email của bạn" name="login_email" value="{{old('login_email')}}">
            <input type="password" placeholder="Mật khẩu" name="login_password">
            <button>Đăng nhập</button>
        </form>

    </div>
    @endauth
    
</body>
</html>