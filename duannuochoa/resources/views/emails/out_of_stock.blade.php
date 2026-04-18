<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #eee;
            border-radius: 10px;
            background-color: #fff;
        }
        .header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 2px solid #f8d7da;
        }
        .header h1 {
            color: #dc3545;
            margin: 0;
            font-size: 24px;
            text-transform: uppercase;
        }
        .content {
            padding: 20px 0;
        }
        .product-info {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            border-left: 4px solid #dc3545;
            margin: 20px 0;
        }
        .product-info p {
            margin: 5px 0;
        }
        .footer {
            text-align: center;
            font-size: 12px;
            color: #777;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }
        .btn {
            display: inline-block;
            padding: 12px 25px;
            background-color: #0052d0;
            color: #ffffff !important;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Cảnh Báo: Hết Hàng!</h1>
        </div>
        <div class="content">
            <p>Chào Ban quản trị,</p>
            <p>Hệ thống vừa ghi nhận một sản phẩm đã chạm mốc <strong>hết hàng (0 sản phẩm)</strong>.</p>
            
            <div class="product-info">
                <p><strong>Sản phẩm:</strong> {{ $variant->product->name }}</p>
                <p><strong>Biến thể:</strong> {{ $variant->volume->name ?? $variant->volume_id }}ml 
                    {{ $variant->color ? '- ' . $variant->color : '' }}</p>
                <p><strong>Thời điểm:</strong> {{ now()->format('H:i d/m/Y') }}</p>
            </div>

            <p>Vui lòng kiểm tra và nhập thêm hàng để tránh ảnh hưởng đến trải nghiệm mua sắm của khách hàng.</p>
            
            <div style="text-align: center;">
                <a href="{{ route('admin.inventory.index', ['status' => 'out_of_stock']) }}" class="btn">Quản lý Kho hàng</a>
            </div>
        </div>
        <div class="footer">
            <p>Đây là email thông báo tự động từ hệ thống Xmen Fragrance.</p>
        </div>
    </div>
</body>
</html>
