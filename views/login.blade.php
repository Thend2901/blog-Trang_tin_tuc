<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Đăng nhập - Blog của tôi</title>
  <link rel="stylesheet" href="{{ asset('css/login.css') }}">

</head>
<body class="auth-page">
  <div class="card form-card">
    <h2>Đăng nhập</h2>
    <div class="auth-switch">
        <span>Chưa có tài khoản? <a href="{{ route('register') }}">Đăng ký</a></span>
    </div>
    <form action="/login" method="post" class="auth-form">
      @csrf
      <div class="form-group">
        <input type="email" name="login_email" id="login_email" value="{{ old('login_email') }}" required>
        <label for="login_email">Email</label>
      </div>
      <div class="form-group">
        <input type="password" name="login_password" id="login_password" required>
        <label for="login_password">Mật khẩu</label>
      </div>

      <button class="btn btn-primary">Đăng nhập</button>
    </form>

    @if($errors->has('login_email'))
      <ul class="error-list">
        <li>{{ $errors->first('login_email') }}</li>
      </ul>
    @endif
  </div>
</body>
</html>