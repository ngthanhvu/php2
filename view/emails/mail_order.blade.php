<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Xác nhận đơn hàng</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            border: 2px solid #FE5722;
            /* Thêm viền màu cam */
        }

        h2 {
            color: #FE5722;
        }

        p {
            font-size: 16px;
            color: #333;
            line-height: 1.5;
        }

        .tracking-code {
            font-size: 18px;
            font-weight: bold;
            color: #FE5722;
        }

        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #777;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <h2>Xác nhận đơn hàng</h2>
        <p>Cảm ơn bạn đã đặt hàng với mã đơn hàng <strong>{{ $order_id }}</strong>!</p>
        <p>Mã vận đơn của bạn là: <span class="tracking-code">{{ $code }}</span></p>
        <p>Nếu có bất kỳ thắc mắc nào, vui lòng liên hệ với chúng tôi.</p>
        <div class="footer">© 2025</div>
    </div>
</body>

</html>
