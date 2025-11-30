{{-- trang sửa bài viết --}}

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sửa bài viết - Blog của tôi</title>
    {{-- Link đến file CSS của bạn --}}
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
</head>
<body>
<div class="container">
    {{-- Sửa link 'Blog của tôi' thành 'Trở về Dashboard' --}}
    <h1 class="site-title"><a href="{{ route('dashboard') }}" style="text-decoration:none; color: inherit;">Trở về Dashboard</a></h1>

    <div class="card create-post"> 
        <h2>Sửa bài viết</h2>
        <form action="/edit-post/{{$post->id}}" method="post">
            @csrf
            @method('put')
            
            {{-- Tiêu đề --}}
            <div class="form-group">
                <input type="text" name="title" placeholder="Tiêu đề bài viết" value="{{ old('title', $post->title) }}">
            </div>
            
            {{-- Nội dung (Dùng 'body') --}}
            <div class="form-group">
                <textarea name="body"  placeholder="Nội dung bài viết">{{ old('body', $post->body) }}</textarea>
            </div>
            
            <div class="form-row" style="display: flex; gap: 20px;">
                
                {{-- DANH MỤC (CATEGORY) --}}
                <div class="form-group" style="flex: 1;">
                    <label for="category_id">Danh mục:</label>
                    <select name="category_id" id="category_id" class="form-control">
                        <option value="">-- Chọn danh mục --</option>
                        {{-- Biến $categories này được truyền từ PostController@showEditScreen --}}
                        @foreach($categories as $category)
                            {{-- Tự động chọn category cũ của post --}}
                            <option value="{{ $category->id }}" {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{--  NHÃN (TAGS) --}}
                <div class="form-group" style="flex: 1;">
                    <label for="tags_input">Nhãn (Tags):</label>
                    {{-- 
                      Dùng $post->tags->pluck('name')->implode(', ') 
                      để lấy danh sách tên tags cũ, nối chúng lại bằng dấu phẩy
                    --}}
                    <input type="text" name="tags_input" id="tags_input" class="form-control" 
                           value="{{ old('tags_input', $post->tags->pluck('name')->implode(', ')) }}">
                    <small>(Các nhãn cách nhau bằng dấu phẩy, ví dụ: laravel, php)</small>
                </div>
            </div>
        
            <div class="form-row" style="display: flex; gap: 20px;">
                
                <div class="form-group" style="flex: 1;">
                    <label for="status">Trạng thái:</label>
                    <select name="status" id="status" class="form-control">
                        <option value="draft" {{ old('status', $post->status) == 'draft' ? 'selected' : '' }}>Nháp (Draft)</option>
                        <option value="published" {{ old('status', $post->status) == 'published' ? 'selected' : '' }}>Xuất bản (Published)</option>
                    </select>
                </div>

                <div class="form-group" style="flex: 1;">
                    <label for="published_at">Ngày xuất bản:</label>
                    {{-- 
                      Phần này xử lý việc format 'datetime' từ database 
                      thành định dạng 'datetime-local' của input
                    --}}
                    <input type="datetime-local" name="published_at" id="published_at" class="form-control" 
                           value="{{ old('published_at', $post->published_at ? \Carbon\Carbon::parse($post->published_at)->format('Y-m-d\TH:i') : '') }}">
                    <small>(Để trống nếu chọn "Xuất bản" sẽ lấy giờ hiện tại)</small>
                </div>

            </div>

            <button class="btn btn-primary" style="margin-top: 1rem;">Lưu bài viết</button>
        </form>
    </div>
</div>


<style>
    .form-control {
        width: 100%;
        padding: 10px 15px;
        border: 1px solid #ced4da;
        border-radius: 6px;
        box-sizing: border-box;
        margin-top: 5px;
    }
    .form-row {
        margin-top: 1rem;
    }
    .form-row label {
        font-weight: 600;
        display: block;
    }
    .form-row small {
        margin-top: 4px;
        color: #6c757d;
        font-size: 0.875em;
        display: block;
    }
    /* Ghi đè lại style cũ trong home.css để các input/textarea không bị dính sát nhau */
    .create-post input[type="text"],
    .create-post textarea,
    .form-control {
        margin-bottom: 0;
    }
    .create-post .form-group {
        margin-bottom: 1rem;
    }
</style>
</body>
</html>