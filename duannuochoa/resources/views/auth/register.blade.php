<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký | {{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="auth-page">
    <div class="auth-container" style="max-width: 500px;">
        <div class="auth-card">
            <div class="auth-header">
                <h1>Tạo tài khoản mới</h1>
                <p>Tham gia với chúng tôi ngay hôm nay</p>
            </div>

            <form action="{{ route('register') }}" method="POST" novalidate>
                @csrf
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                    <div class="form-group">
                        <label for="username">Tên đăng nhập</label>
                        <input type="text" id="username" name="username" value="{{ old('username') }}" placeholder="tuanpham">
                        @error('username')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="full_name">Họ và tên</label>
                        <input type="text" id="full_name" name="full_name" value="{{ old('full_name') }}" required placeholder="Phạm Tuân">
                        @error('full_name')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">Địa chỉ Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="example@gmail.com">
                    @error('email')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                    <div class="form-group">
                        <label for="password">Mật khẩu</label>
                        <input type="password" id="password" name="password" required placeholder="••••••••">
                        @error('password')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Xác nhận mật khẩu</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required placeholder="••••••••">
                    </div>
                </div>

                <div class="form-group">
                    <label for="phone">Số điện thoại (tùy chọn)</label>
                    <input type="text" id="phone" name="phone" value="{{ old('phone') }}" placeholder="0123456789">
                    @error('phone')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="address">Địa chỉ (tùy chọn)</label>
                    <input type="text" id="address" name="address" value="{{ old('address') }}" placeholder="Hà Nội, Việt Nam">
                    @error('address')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn">Đăng ký tài khoản</button>
            </form>

            <div class="auth-footer">
                Đã có tài khoản? <a href="{{ route('login') }}">Đăng nhập</a>
            </div>
            <div class="auth-footer" style="margin-top: 10px;">
                <a href="{{ url('/') }}">Quay lại trang chủ</a>
            </div>
        </div>
    </div>
</body>
</html>
