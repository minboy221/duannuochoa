<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập | {{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="auth-page">
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <h1>Chào mừng trở lại</h1>
                <p>Vui lòng đăng nhập vào tài khoản của bạn</p>
            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="login">Email hoặc Tên đăng nhập</label>
                    <input type="text" id="login" name="login" value="{{ old('login') }}" required autofocus placeholder="example@gmail.com">
                    @error('login')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <label for="password">Mật khẩu</label>
                        <a href="{{ route('password.request') }}" style="font-size: 13px; color: var(--primary); text-decoration: none;">Quên mật khẩu?</a>
                    </div>
                    <input type="password" id="password" name="password" required placeholder="••••••••">
                    @error('password')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group" style="display: flex; align-items: center; gap: 8px;">
                    <input type="checkbox" id="remember" name="remember" style="width: auto;">
                    <label for="remember" style="margin-bottom: 0; font-weight: 400;">Ghi nhớ đăng nhập</label>
                </div>

                <button type="submit" class="btn">Đăng nhập</button>
            </form>

            <div class="auth-footer">
                Chưa có tài khoản? <a href="{{ route('register') }}">Đăng ký ngay</a>
            </div>
            <div class="auth-footer" style="margin-top: 10px;">
                <a href="{{ url('/') }}">Quay lại trang chủ</a>
            </div>
        </div>
    </div>
</body>
</html>
