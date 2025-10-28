<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>sửa bài viết </title>
</head>
<body>
    <h1><a href="/" style="text-decoration:none">Blog của tôi</a></h1>
     <h2>Tạo bài viết</h2>
    <form action="/edit-post/{{$post->id}}" method="post">
        @csrf
        @method('put')
        <input type="text" name="title" placeholder="Tiêu đề bài viết" value="{{$post->title}}"> >
        <textarea name="body"  placeholder="Nội dung bài viết">{{$post->body}}</textarea>
        <button>lưu bài viết</button>
    </form>
</body>
</html>