<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đổi mật khẩu | {{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="auth-page">
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <h1>Đổi mật khẩu</h1>
                <p>Cập nhật mật khẩu bảo mật của bạn</p>
            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('password.change.send') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="current_password">Mật khẩu hiện tại</label>
                    <input type="password" id="current_password" name="current_password" required placeholder="••••••••">
                    @error('current_password')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="new_password">Mật khẩu mới</label>
                    <input type="password" id="new_password" name="new_password" required placeholder="••••••••">
                    @error('new_password')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="new_password_confirmation">Xác nhận mật khẩu mới</label>
                    <input type="password" id="new_password_confirmation" name="new_password_confirmation" required placeholder="••••••••">
                </div>

                <button type="submit" class="btn">Gửi mã OTP xác nhận</button>
            </form>

            <div class="auth-footer">
                <a href="{{ url('/') }}">Quay lại trang chủ</a>
            </div>
        </div>
    </div>
</body>
</html>
