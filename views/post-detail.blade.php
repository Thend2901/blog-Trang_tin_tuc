{{-- trang chi tiết bài viết --}}

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->title }}</title> 
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/new-layout.css') }}">
    <link rel="alternate" type="application/rss+xml" title="RSS Feed Blog của tôi" href="{{ url('/feed') }}">

    {{-- (PHẦN MỚI) CSS CHO BÌNH LUẬN --}}
    <style>
        /* (CSS cũ của Giai đoạn 7.1/7.2) */
        .post-category a, .tag-link { text-decoration: none; color: #007bff; margin-right: 5px; padding: 2px 6px; background-color: #f1f3f5; border-radius: 4px; }
        .tag-link { color: #495057; margin-right: 8px; font-size: 0.95em; display: inline-block; margin-bottom: 5px; }
        .post-category a:hover, .tag-link:hover { background-color: #e9ecef; text-decoration: underline; }
        .post-meta-item { margin-left: 20px; }

        /* (CSS MỚI CHO BÌNH LUẬN) */
        .comments-section {
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid #eee;
        }
        .comments-section h3 {
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
        }
        .comment-form textarea {
            width: 100%;
            min-height: 100px;
            padding: 10px 15px;
            border: 1px solid #ced4da;
            border-radius: 6px;
            box-sizing: border-box;
            font-size: 1rem;
            margin-bottom: 1rem;
        }
        .comment-item {
            display: flex;
            gap: 15px;
            margin-bottom: 1.5rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid #f1f3f5;
        }
        .comment-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #e9ecef;
            color: #6c757d;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            flex-shrink: 0;
        }
        .comment-content .comment-author {
            font-weight: 600;
            color: #333;
        }
        .comment-content .comment-date {
            font-size: 0.85em;
            color: #6c757d;
            margin-left: 10px;
        }
        .comment-content p {
            margin-top: 5px;
            margin-bottom: 0;
            line-height: 1.6;
            color: #333;
        }
        .btn-comment {
            background-color: #007bff;
            color: white;
            padding: 8px 16px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            display: inline-block;
            margin-top: 10px;
        }
        .btn-comment:hover {
            background-color: #0056b3;
            color: white;
        }
    </style>
</head>
<body>
<div class="container">
    <h1 class="site-title"><a href="/" style="text-decoration:none; color: inherit;">Trở về trang chủ</a></h1>

    <div class="auth-links">
        {{-- (Code Auth/Search header giữ nguyên) --}}
        <div class="sidebar-search-form">
            <form action="{{ route('search') }}" method="GET">
                <input type="search" name="query" placeholder="Tìm kiếm..." value="{{ request('query') }}">
            </form>
        </div>
        <div class="auth-session-links">
            @auth
                <span style="margin-right: 15px;">Chào, <strong>{{ auth()->user()->name }}</strong>!</span>
                <a href="{{ route('dashboard') }}" class="btn btn-primary">Trang quản lý</a>
                <form action="/logout" method="get" class="logout-form">
                    <button class="btn btn-logout">Đăng xuất</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn-secondary">Đăng nhập</a>
                <a href="{{ route('register') }}" class="btn btn-primary" style="margin-left: 10px;">Đăng ký</a>
            @endauth
        </div>
    </div>
    <div class="page-container">
        {{-- (Code Sidebar giữ nguyên) --}}
        <aside class="sidebar">
            <div class="sidebar-widget sidebar-about-me">
                <h4>About Me</h4>
                <img src="https://placehold.co/120x120/e0e0e0/888?text=AVATAR" alt="About me avatar">
                <p>HEY THERE. I view photography the way I view life: magical and full of possibility.</p>
            </div>
            <div class="sidebar-widget sidebar-categories">
                <h4>Categories</h4>
                <ul>
                    @if(isset($all_categories))
                        @foreach($all_categories as $category)
                            <li class="{{ (isset($post->category) && $post->category->id == $category->id) ? 'active' : '' }}">
                                <a href="{{ route('category.posts', $category->slug) }}">
                                    {{ $category->name }}
                                </a>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </aside>
        <main class="main-content">
            {{-- (Code bài viết giữ nguyên) --}}
            <div class="card post-detail-content" style="padding: 2rem 3rem;">
                <h1 style="font-size: 2.5rem; margin-top: 0; line-height: 1.3;">{{ $post->title }}</h1>
                <div class="post-meta">
                    <span class="author">Người viết: <strong>{{ $post->user->name }}</strong></span>
                    <span class="views post-meta-item">Lượt xem: <strong>{{ $post->view_count }}</strong></span>
                    @if($post->category)
                        <span class="post-category post-meta-item">
                            Danh mục: <a href="{{ route('category.posts', $post->category->slug) }}">{{ $post->category->name }}</a>
                        </span>
                    @endif
                </div>
                <hr style="margin: 1.5rem 0; border: 0; border-top: 1px solid #eee;">
                <div class="post-body">
                    {!! nl2br(e($post->body)) !!}
                </div>
                @if($post->tags->isNotEmpty())
                    <hr style="margin-top: 2rem; border: 0; border-top: 1px solid #eee;">
                    <div class="post-tags-list" style="margin-top: 1.5rem;">
                        <strong style="color: #343a40; display: block; margin-bottom: 10px;">Tags:</strong>
                        @foreach($post->tags as $tag)
                            <a href="#" class="tag-link">#{{ $tag->name }}</a>
                        @endforeach
                    </div>
                @endif
                
                {{-- NÚT BÌNH LUẬN  --}}
                <a href="#comments-section" class="btn-comment">
                    Bình luận ({{ $post->comments->count() }})
                </a>
                
                {{-- KHU VỰC BÌNH LUẬN   --}}
                <div id="comments-section" class="comments-section">
                    <h3>Bình luận ({{ $post->comments->count() }})</h3>

                    {{-- 1. FORM ĐỂ VIẾT BÌNH LUẬN --}}
                    {{-- Chỉ hiển thị nếu user ĐÃ ĐĂNG NHẬP --}}
                    @auth
                        @if(session('message'))
                            {{-- Hiển thị thông báo (ví dụ: "Đã gửi bình luận!") --}}
                            <div class="alert success" style="margin-bottom: 1rem; background-color: #d4edda; color: #155724; padding: 10px 15px; border-radius: 6px;">
                                {{ session('message') }}
                            </div>
                        @endif

                        <form action="{{ route('comments.store', $post->slug) }}" method="POST" class="comment-form">
                            @csrf
                            <textarea name="content" placeholder="Viết bình luận của bạn..." required>{{ old('content') }}</textarea>
                            @error('content')
                                <p style="color: red; font-size: 0.9em; margin-top: -10px; margin-bottom: 10px;">{{ $message }}</p>
                            @enderror
                            <button type="submit" class="btn btn-primary">Gửi bình luận</button>
                        </form>
                    @else
                        {{-- Hiển thị nếu user LÀ KHÁCH --}}
                        <p style="text-align: center; background-color: #f8f9fa; padding: 1.5rem; border-radius: 6px;">
                            Vui lòng <a href="{{ route('login') }}"><strong>đăng nhập</strong></a> để để lại bình luận.
                        </p>
                    @endauth

                    {{-- 2. DANH SÁCH CÁC BÌNH LUẬN CŨ --}}
                    <div class="comment-list" style="margin-top: 2rem;">
                        @if($post->comments->isEmpty())
                            <p style="color: #6c757d;">Chưa có bình luận nào. Hãy là người đầu tiên!</p>
                        @else
                            @foreach($post->comments->sortByDesc('created_at') as $comment)
                                <div class="comment-item">
                                    {{-- Avatar (chữ cái đầu) --}}
                                    <div class="comment-avatar">
                                        {{-- Lấy chữ cái đầu tiên của tên user --}}
                                        {{ strtoupper(substr($comment->user->name, 0, 1)) }}
                                    </div>
                                    <div class="comment-content">
                                        <span class="comment-author">{{ $comment->user->name }}</span>
                                        <span class="comment-date">{{ $comment->created_at->diffForHumans() }}</span>
                                        <p>{{ $comment->content }}</p>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
</body>
</html>