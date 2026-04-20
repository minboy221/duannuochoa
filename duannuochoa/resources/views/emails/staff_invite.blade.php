<!DOCTYPE html>
<html>
<head>
    <title>Tài khoản Hệ thống</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px;">
    
    <div style="text-align: center; margin-bottom: 20px;">
        <h2 style="color: #0052d0;">Chào mừng gia nhập {{ config('app.name') }}!</h2>
    </div>

    <p>Xin chào <strong>{{ $user->full_name }}</strong>,</p>

    <p>Tài khoản nhân sự của bạn trên hệ thống <strong>{{ config('app.name') }}</strong> vừa được tạo thành công bởi Quản trị viên.</p>

    <div style="background-color: #f6f6ff; border-left: 4px solid #0052d0; padding: 15px; margin: 20px 0;">
        <p style="margin: 0 0 10px 0;"><strong>Thông tin đăng nhập của bạn:</strong></p>
        <p style="margin: 5px 0;"><strong>Email:</strong> {{ $user->email }}</p>
        <p style="margin: 5px 0;"><strong>Mật khẩu tạm thời:</strong> <span style="background-color: #e2e8f0; padding: 2px 6px; border-radius: 4px; font-family: monospace;">{{ $plainPassword }}</span></p>
    </div>

    <p style="color: #b31b25;"><strong>LƯU Ý QUAN TRỌNG:</strong> Vì lý do bảo mật, vui lòng đăng nhập và thay đổi mật khẩu của bạn ngay trong lần truy cập đầu tiên.</p>

    <div style="text-align: center; margin: 30px 0;">
        <a href="{{ url('/dang-nhap') }}" style="background-color: #0052d0; color: #ffffff; padding: 12px 25px; text-decoration: none; border-radius: 10px; font-weight: bold; display: inline-block;">
            Truy cập hệ thống ngay
        </a>
    </div>

    <p>Trân trọng,</p>
    <p>Ban Quản trị viên <strong>{{ config('app.name') }}</strong></p>

    <hr style="border: none; border-top: 1px solid #eee; margin-top: 30px;" />
    <p style="font-size: 12px; color: #999; text-align: center;">Đây là email tự động từ hệ thống. Vui lòng không trả lời email này.</p>
</body>
</html>
