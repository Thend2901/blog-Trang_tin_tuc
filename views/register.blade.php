<!DOCTYPE html>
<html lang="vi">
<head>

       <meta charset="UTF-8">

 <meta name="viewport" content="width=device-width, initial-scale=1.0">

 <title>Đăng ký - Blog của tôi</title>

 <link rel="stylesheet" href="{{ asset('css/register.css') }}"> 
</head>
<body class="auth-page">
  
  {{-- Chỉ giữ lại .card.form-card làm nội dung chính --}}

   <div class="card form-card">
    
 <h2>Đăng ký</h2>
 <div class="auth-switch">
  <span>Bạn đã có tài khoản? <a href="{{ route('login') }}">Đăng nhập</a></span>
 </div>

 <form action="/register" method="post" class="auth-form">
 
       @csrf
      {{-- Các trường này thẳng hàng và chỉ có gạch chân (theo CSS) --}}
      <div class="form-group">
   
             <input type="text" name="name" id="name" value="{{ old('name') }}" required>
        <label for="name">Tên đăng nhập</label>
      </div>
      <div class="form-group">
   
             <input type="email" name="email" id="email" value="{{ old('email') }}" required>
        <label for="email">Email</label>
      </div>
      <div class="form-group">
   
             <input type="password" name="password" id="password" required>
        <label for="password">Mật khẩu</label>
      </div>
      <div class="form-group">
   
             <input type="password" name="password_confirmation" id="password_confirmation" required>
        <label for="password_confirmation">Xác nhận mật khẩu</label>
      </div>
 
       
      {{-- Nút Đăng ký kiểu outline --}}
 
       <button class="btn btn-primary">Đăng ký</button>
 </form>

 @if($errors->any())
 
  <ul class="error-list">
  @foreach($errors->all() as $error)
  
   <li>{{ $error }}</li>
  @endforeach
 
 </ul>
 @endif
</div>
</body>
</html>
