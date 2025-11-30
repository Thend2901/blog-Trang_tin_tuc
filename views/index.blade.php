{{-- trang chủ hiển thị danh sách bài viết --}}

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog của tôi</title>
    {{-- Dùng chung CSS với trang dashboard --}}
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
<link rel="alternate" type="application/rss+xml" title="RSS Feed Blog của tôi" href="{{ url('/feed') }}">
</head>
<body>  
<div class="container">
    <h1 class="site-title"><a href="/" style="text-decoration:none; color: inherit;">Blog của tôi</a></h1>

    {{-- PHẦN LINK ĐĂNG NHẬP / QUẢN LÝ --}}
    <div class="auth-links" style="text-align: right; margin-bottom: 2rem; padding: 10px; background: #f8f9fa; border-radius: 8px;">
        {{-- Form tìm kiếm bài viết --}}
        <form action="{{ route('search') }}" method="GET" class="search-form">
            <input type="search" name="query" placeholder="Tìm kiếm bài viết..." value="{{ request('query') }}">
            <button type="submit" class="btn btn-secondary" style="padding: 8px 12px;">Tìm</button>
        </form>
        @auth
            {{-- Nếu đã đăng nhập, hiển thị link đến trang Dashboard --}}
            <span style="margin-right: 15px;">Chào, <strong>{{ auth()->user()->name }}</strong>!</span>
            <a href="{{ route('dashboard') }}" class="btn btn-primary">Trang quản lý</a>
            <form action="/logout" method="get" class="logout-form" style="display: inline-block; margin-left: 10px;">
                <button class="btn btn-logout">Đăng xuất</button>
            </form>
        @else
            {{-- Nếu là khách, hiển thị link Đăng nhập / Đăng ký --}}
            <a href="{{ route('login') }}" class="btn btn-secondary">Đăng nhập</a>
            <a href="{{ route('register') }}" class="btn btn-primary" style="margin-left: 10px;">Đăng ký</a>
        @endauth
    </div>

    <div class="card post-list">
        <h2>Bài viết mới nhất</h2>

        @if($posts->isEmpty())
            {{-- Hiển thị nếu không có bài viết nào --}}
            <p style="padding: 20px 0; text-align: center; color: #6c757d;">
                Chưa có bài viết nào được xuất bản.
            </p>
        @else
            {{-- Lặp qua các bài viết đã được lọc --}}
            @foreach($posts as $post)<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog của tôi</title>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">

    {{-- Thêm CSS cho Tags/Categories --}}
    <style>
        .post-meta-tags {
            margin-top: 10px;
            font-size: 0.9rem;
            color: #555;
        }
        .post-category a, .post-tags a {
            text-decoration: none;
            color: #007bff;
            margin-right: 5px;
            padding: 2px 6px;
            background-color: #f1f3f5;
            border-radius: 4px;
        }
        .post-tags a {
            color: #495057;
        }
        .post-category a:hover, .post-tags a:hover {
            background-color: #e9ecef;
            text-decoration: underline;
        }
        .post-meta-tags > span {
            display: inline-block;
            margin-right: 15px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1 class="site-title"><a href="/" style="text-decoration:none; color: inherit;">Blog của tôi</a></h1>

    {{-- PHẦN LINK ĐĂNG NHẬP / QUẢN LÝ  --}}
    <div class="auth-links" style="text-align: right; margin-bottom: 2rem; padding: 10px; background: #f8f9fa; border-radius: 8px;">
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

    <div class="card post-list">
        <h2>Bài viết mới nhất</h2>

        @if($posts->isEmpty())
            <p style="padding: 20px 0; text-align: center; color: #6c757d;">
                Chưa có bài viết nào được xuất bản.
            </p>
        @else
            @foreach($posts as $post)
            <div class="post-item">
                <h3><a href="{{ route('post.detail', $post->slug) }}">{{ $post->title }}</a></h3>
                
                <p>{{ Str::limit(e($post->body), 150) }}</p>

                {{-- =============================================== --}}
                {{--  HIỂN THỊ CATEGORY & TAGS --}}
                {{-- =============================================== --}}
                <div class="post-meta-tags">
                    {{-- 1. Hiển thị Category (nếu có) --}}
                    @if($post->category)
                        <span class="post-category">
                            {{-- TODO: Link này sau sẽ dùng để lọc theo Category --}}
                            <a href="#">{{ $post->category->name }}</a>
                        </span>
                    @endif

                    {{-- 2. Hiển thị Tags (nếu có) --}}
                    @if($post->tags->isNotEmpty())
                        <span class="post-tags">
                            @foreach($post->tags as $tag)
                                {{-- TODO: Link này sau sẽ dùng để lọc theo Tag --}}
                                <a href="#">#{{ $tag->name }}</a>
                            @endforeach
                        </span>
                    @endif
                </div>

                <p class="author" style="margin-top: 10px;"> {{-- Thêm style để đẩy phần author xuống --}}
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
            <div class="post-item">
                {{-- Link đến trang chi tiết bài viết (dùng slug) --}}
                <h3><a href="{{ route('post.detail', $post->slug) }}">{{ $post->title }}</a></h3>
                
                {{-- Hiển thị tóm tắt (150 ký tự) --}}
                <p>{{ Str::limit(e($post->body), 150) }}</p>

                <p class="author">
                    Người viết: <strong>{{ $post->user->name }}</strong>
                    <span style="margin-left: 15px; color: #6c757d; font-size: 0.9em;">
                        {{-- Hiển thị ngày đăng (đã format) --}}
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
