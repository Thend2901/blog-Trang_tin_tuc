{{-- phần này là trang kết quả tìm kiếm --}}


<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết quả tìm kiếm cho '{{ $query }}'</title>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/public-styles.css') }}">
    <link rel="alternate" type="application/rss+xml" title="RSS Feed Blog của tôi" href="{{ url('/feed') }}">

</head>
<body>
<div class="container">
    <h1 class="site-title"><a href="/" style="text-decoration:none; color: inherit;">Trở về trang chủ</a></h1>

    {{-- PHẦN LINK ĐĂNG NHẬP / QUẢN LÝ / TÌM KIẾM --}}
    <div class="auth-links" style="padding: 10px; background: #f8f9fa; border-radius: 8px;">
        
        {{-- Form Tìm kiếm --}}
        <form action="{{ route('search') }}" method="GET" class="search-form">
            <input type="search" name="query" placeholder="Tìm kiếm bài viết..." value="{{ $query }}">
            <button type="submit" class="btn btn-secondary" style="padding: 8px 12px;">Tìm</button>
        </form>

        {{-- Phần Đăng nhập/Đăng xuất --}}
        <div class="auth-session-links">
            @auth
                <span style="margin-right: 15px;">Chào, <strong>{{ auth()->user()->name }}</strong>!</span>
                <a href="{{ route('dashboard') }}" class="btn btn-primary">Trang quản lý</a>
                <form action="/logout" method="get" class="logout-form" style="display: inline-block; margin-left: 10px;">
                    <button class="btn btn-logout">Đăng xuất</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn-secondary">Đăng nhập</a>
                <a href="{{ route('register') }}" class="btn btn-primary" style="margin-left: 10px;">Đăng ký</a>
            @endauth
        </div>
    </div>

    {{-- Danh sách kết quả  --}}
    <div class="card post-list" style="margin-top: 2rem;">
        <h2>Kết quả tìm kiếm cho: '{{ $query }}'</h2>

        @if($posts->isEmpty())
            <p style="padding: 20px 0; text-align: center; color: #6c757d;">
                Không tìm thấy bài viết nào phù hợp với từ khóa của bạn.
            </p>
        @else
            @foreach($posts as $post)
            <div class="post-item">
                <h3><a href="{{ route('post.detail', $post->slug) }}">{{ $post->title }}</a></h3>
                <p>{{ Str::limit(e($post->body), 150) }}</p>
                
                {{-- Hiển thị Category & Tags --}}
                <div class="post-meta-tags">
                    @if($post->category)
                        <span class="post-category">
                            <a href="#">{{ $post->category->name }}</a>
                        </span>
                    @endif
                    @if($post->tags->isNotEmpty())
                        <span class="post-tags">
                            @foreach($post->tags as $tag)
                                <a href="#">#{{ $tag->name }}</a>
                            @endforeach
                        </span>
                    @endif
                </div>

                <p class="author" style="margin-top: 10px;">
                    Người viết: <strong>{{ $post->user->name }}</strong>
                    <span style="margin-left: 15px; color: #6c757d; font-size: 0.9em;">
                        Đăng ngày: {{ $post->published_at->format('d/m/Y') }}
                    </span>
                </p>
            </div>
            @endforeach
        @endif
    </div>
</div>
</body>
</html>