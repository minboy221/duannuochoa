<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt lại mật khẩu | {{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="auth-page">
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <h1>Đặt lại mật khẩu</h1>
                <p>Vui lòng nhập mật khẩu mới cho tài khoản của bạn</p>
                <div style="font-weight: 600; margin-top: 5px; color: var(--text);">{{ session('reset_email') }}</div>
            </div>

            <form action="{{ route('password.update') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="password">Mật khẩu mới</label>
                    <input type="password" id="password" name="password" required autofocus placeholder="••••••••">
                    @error('password')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Xác nhận mật khẩu</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required placeholder="••••••••">
                </div>

                <button type="submit" class="btn">Cập nhật mật khẩu</button>
            </form>
        </div>
    </div>
</body>
</html>
