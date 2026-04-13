<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác thực đổi mật khẩu | {{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="auth-page">
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <h1>Xác thực OTP</h1>
                <p>Để bảo mật, vui lòng nhập mã OTP đã gửi đến email của bạn</p>
                <div style="font-weight: 600; margin-top: 5px; color: var(--text);">{{ Auth::user()->email }}</div>
            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('password.change.update') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="otp" style="text-align: center;">Nhập mã OTP</label>
                    <input type="text" id="otp" name="otp" required autofocus 
                           placeholder="123456" maxlength="6" 
                           style="text-align: center; letter-spacing: 10px; font-size: 24px; font-weight: 700;">
                    @error('otp')
                        <div class="error-message" style="text-align: center;">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn">Xác nhận và đổi mật khẩu</button>
            </form>

            <div class="auth-footer">
                Chưa nhận được mã? <a href="{{ route('password.change') }}">Quay lại</a>
            </div>
        </div>
    </div>
</body>
</html>
