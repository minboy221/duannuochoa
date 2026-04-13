<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quên mật khẩu | {{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="auth-page">
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <h1>Quên mật khẩu?</h1>
                <p>Nhập email của bạn để nhận mã OTP khôi phục</p>
            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('password.email') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="email">Địa chỉ Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus placeholder="example@gmail.com">
                    @error('email')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn">Gửi mã OTP</button>
                <a href="{{ route('login') }}" class="btn btn-secondary" style="display: block; text-align: center; text-decoration: none;">Quay lại đăng nhập</a>
            </form>
        </div>
    </div>
</body>
</html>
