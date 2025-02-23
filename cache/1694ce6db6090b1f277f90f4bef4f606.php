<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Cập nhật trạng thái đơn hàng</title>
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
            border: 2px solid #17a2b8;
        }

        h2 {
            color: #17a2b8;
            font-size: 24px;
            margin-bottom: 15px;
        }

        p {
            font-size: 16px;
            color: #333;
            line-height: 1.5;
        }

        .status {
            font-size: 18px;
            font-weight: bold;
            padding: 8px 15px;
            border-radius: 5px;
            display: inline-block;
            margin-top: 10px;
        }

        .completed {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .cancel {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .pending {
            background-color: #fff3cd;
            color: #856404;
            border: 1px solid #ffeeba;
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
        <h2>Cập nhật trạng thái đơn hàng</h2>
        <p>Xin chào <strong><?php echo e($name); ?></strong>,</p>
        <p>Đơn hàng của bạn (<strong>#<?php echo e($order_id); ?></strong>) đã được cập nhật trạng thái:</p>

        <p
            class="status 
            <?php if($status == 'completed'): ?> completed 
            <?php elseif($status == 'cancel'): ?> cancel 
            <?php elseif($status == 'pending'): ?> pending <?php endif; ?>">
            <?php echo e($status); ?>

        </p>

        <p>Cảm ơn bạn đã mua hàng!</p>
        <div class="footer">© 2025</div>
    </div>
</body>

</html>
<?php /**PATH D:\FPOLY\PHP2\asm_gd1\view/emails/mail_status.blade.php ENDPATH**/ ?>