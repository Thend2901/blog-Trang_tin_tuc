
<div class="card create-post">
    <h2>Tạo bài viết</h2>
    <form action="/create-post" method="post">
        @csrf
        
        {{-- Tiêu đề --}}
        <div class="form-group">
            <input type="text" name="title" placeholder="Tiêu đề bài viết" value="{{ old('title') }}">
        </div>
        
        
        <div class="form-group">
            <textarea name="body"  placeholder="Nội dung bài viết">{{ old('body') }}</textarea>
        </div>

        <div class="form-row" style="display: flex; gap: 20px;">
            
            {{-- DANH MỤC (CATEGORY) --}}
            <div class="form-group" style="flex: 1;">
                <label for="category_id">Danh mục:</label>
                <select name="category_id" id="category_id" class="form-control">
                    <option value="">-- Chọn danh mục --</option>
                    {{-- Biến $categories này sẽ được truyền từ Controller/Route --}}
                    @if(isset($categories)) {{-- Kiểm tra $categories có tồn tại không --}}
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    @endif
                </select>
            </div>

            {{-- 2. NHÃN (TAGS) --}}
            <div class="form-group" style="flex: 1;">
                <label for="tags_input">Nhãn (Tags):</label>
                <input type="text" name="tags_input" id="tags_input" class="form-control" value="{{ old('tags_input') }}">
                <small>(Các nhãn cách nhau bằng dấu phẩy, ví dụ: laravel, php)</small>
            </div>
        </div>

        <div class="form-row" style="display: flex; gap: 20px;">
            
            <div class="form-group" style="flex: 1;">
                <label for="status">Trạng thái:</label>
                <select name="status" id="status" class="form-control">
                    <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Nháp (Draft)</option>
                    <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Xuất bản (Published)</option>
                </select>
            </div>

            <div class="form-group" style="flex: 1;">
                <label for="published_at">Ngày xuất bản:</label>
                <input type="datetime-local" name="published_at" id="published_at" class="form-control" value="{{ old('published_at') }}">
                <small>(Để trống nếu chọn "Xuất bản" sẽ lấy giờ hiện tại)</small>
            </div>

        </div>

        <button class="btn btn-primary" style="margin-top: 1rem;">Tạo bài viết</button>
    </form>
</div>

{{-- Thêm CSS (Copy từ file create-post-form) --}}
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