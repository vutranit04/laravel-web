<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
            padding: 20px;
            color: #333;
        }
        .email-container {
            max-width: 550px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }
        .header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }
        .btn-reset {
            display: inline-block;
            background-color: #4f46e5;
            color: #ffffff !important;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
            margin: 20px 0;
        }
        .footer {
            margin-top: 30px;
            font-size: 12px;
            color: #777;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h2>Yêu cầu đặt lại mật khẩu</h2>
        </div>
        <p>Xin chào <strong>{{ $user->fullname }}</strong>,</p>
        <p>Chúng tôi nhận được yêu cầu đặt lại mật khẩu cho tài khoản <strong>{{ $user->email }}</strong> của bạn trên hệ thống Quản trị.</p>
        <p>Vui lòng nhấn vào nút bên dưới để tiến hành đặt lại mật khẩu mới:</p>
        <div style="text-align: center;">
            <a href="{{ route('admin.resetpassword', ['token' => $token, 'email' => $user->email]) }}" class="btn-reset">Đặt lại mật khẩu</a>
        </div>
        <p>Nếu nút trên không hoạt động, bạn có thể sao chép liên kết sau vào trình duyệt:</p>
        <p style="word-break: break-all;"><a href="{{ route('admin.resetpassword', ['token' => $token, 'email' => $user->email]) }}">{{ route('admin.resetpassword', ['token' => $token, 'email' => $user->email]) }}</a></p>
        <p>Liên kết này có hiệu lực trong vòng 60 phút. Nếu bạn không thực hiện yêu cầu này, vui lòng bỏ qua email này.</p>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Admin Panel - MyWeb. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
