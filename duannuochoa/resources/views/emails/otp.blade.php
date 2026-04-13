<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background-color: #f4f7f9;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }
        .header {
            background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
            padding: 40px 20px;
            text-align: center;
            color: white;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 700;
            letter-spacing: -0.5px;
        }
        .content {
            padding: 40px 30px;
            color: #374151;
            line-height: 1.6;
        }
        .otp-box {
            background-color: #f3f4f6;
            padding: 24px;
            text-align: center;
            border-radius: 8px;
            margin: 30px 0;
        }
        .otp-code {
            font-size: 32px;
            font-weight: 800;
            letter-spacing: 8px;
            color: #4f46e5;
            margin: 0;
        }
        .footer {
            padding: 20px 30px;
            text-align: center;
            font-size: 14px;
            color: #9ca3af;
            border-top: 1px solid #f3f4f6;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Xác thực tài khoản</h1>
        </div>
        <div class="content">
            <p>Xin chào,</p>
            <p>Bạn đã yêu cầu nhận mã OTP để 
                <strong>
                    @if($type === 'forgot') khôi phục mật khẩu @elseif($type === 'change') thay đổi mật khẩu @else đăng ký tài khoản @endif
                </strong>.
            </p>
            <p>Vui lòng sử dụng mã bên dưới để tiếp tục. Mã này có hiệu lực trong 10 phút.</p>
            
            <div class="otp-box">
                <p class="otp-code">{{ $otp }}</p>
            </div>
            
            <p>Nếu bạn không thực hiện yêu cầu này, vui lòng bỏ qua email này hoặc liên kết hỗ trợ của chúng tôi.</p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
        </div>
    </div>
</body>
</html>
