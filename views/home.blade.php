{{-- trang dashboard quản lý bài viết của người dùng --}}

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard - Blog của tôi</title>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
<link rel="alternate" type="application/rss+xml" title="RSS Feed Blog của tôi" href="{{ url('/feed') }}">
</head>
<body>
<div class="container">
    <h1 class="site-title"><a href="/" style="text-decoration:none; color: inherit;">Về trang chủ công khai</a></h1>

    @if(session('message'))
       <div class="alert success">{{session('message')}}</div>        
    @endif

    @auth
        <h2 class="welcome">Chào mừng <span class="username">{{$user->name}}</span> (Trang quản lý)</h2>
        <form action="/logout" method="get" class="logout-form">
            <button class="btn btn-logout">Đăng xuất</button>
        </form>

        {{-- Form tạo bài viết  --}}
        @include('create-post-form')

        <div class="card post-list">
            <h2>Danh sách bài viết của bạn (Tất cả)</h2>
            @foreach($posts as $post)
            <div class="post-item">
                
                <h3>{{$post->title}}</h3>

                {{--  Hiển thị thông tin Status, Views --}}
                <div style="margin-bottom: 10px; font-size: 0.9em; color: #6c757d;">
                    <span>Trạng thái: <strong>{{ $post->status == 'draft' ? 'Nháp' : 'Xuất bản' }}</strong></span>
                    <span style="margin-left: 15px;">Lượt xem: <strong>{{ $post->view_count }}</strong></span>
                    <span style="margin-left: 15px;">Ngày đăng: <strong>{{ $post->published_at ? $post->published_at : 'Chưa đặt' }}</strong></span>
                </div>
                <div class="post-meta-tags" style="margin-top: 5px; font-size: 0.9em; color: #6c757d;">
                    {{-- Hiển thị Category  --}}
                @if($post->category)
                    <span class="post-category" style="margin-right: 15px;">
                     Danh mục: <strong>{{ $post->category->name }}</strong>
                    </span>
                @endif    
                    {{--  Hiển thị Tags  --}}
                @if($post->tags->isNotEmpty())
                    <span class="post-tags">
                    Tags:
                      @foreach($post->tags as $tag)
                        <strong style="margin-right: 5px;">#{{ $tag->name }}</strong>
                      @endforeach
                    </span>
                @endif
                </div>

                <p>{{ Str::limit(e($post->body), 150) }}</p>
                
                <div class="post-actions">
                    {{-- Sửa lại route {id} thành {post} --}}
                    <a href="/edit-post/{{$post->id}}" class="btn btn-edit">Sửa</a>
                    <form action="/delete-post/{{$post->id}}" method="POST" class="inline-form">
                        @csrf
                        @method('delete')
                        <button class="btn btn-delete">Xoá</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    
    {{-- Nếu người dùng chưa đăng nhập , dù route này đã được bảo vệ, để cho an toàn --}}
    @else 
    <div class="auth-container" style="text-align: center; padding: 50px;">
        <h2>Bạn cần đăng nhập</h2>
        <p>Vui lòng đăng nhập để truy cập trang quản lý.</p>
        <a href="{{ route('login') }}" class="btn btn-secondary">Đăng nhập</a>
    </div>
    @endauth
</div>
</body>
</html>
