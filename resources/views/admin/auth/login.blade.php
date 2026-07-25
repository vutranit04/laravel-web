<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đăng nhập hệ thống</title>
    {{-- CDN Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #0f0c29 0%, #302b63 50%, #24243e 100%);
            overflow: hidden;
            position: relative;
        }

        /* Animated background orbs */
        body::before,
        body::after {
            content: '';
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.4;
            animation: float 8s ease-in-out infinite;
        }

        body::before {
            width: 400px;
            height: 400px;
            background: #667eea;
            top: -100px;
            right: -100px;
        }

        body::after {
            width: 350px;
            height: 350px;
            background: #764ba2;
            bottom: -80px;
            left: -80px;
            animation-delay: -4s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0) scale(1); }
            50% { transform: translateY(-30px) scale(1.05); }
        }

        .login-container {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 420px;
            padding: 0 1rem;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 20px;
            padding: 2.5rem 2rem;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
            animation: slideUp 0.6s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-icon {
            width: 64px;
            height: 64px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            font-size: 1.8rem;
            color: #fff;
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
        }

        .login-card h2 {
            color: #fff;
            font-weight: 700;
            font-size: 1.5rem;
            text-align: center;
            margin-bottom: 0.3rem;
        }

        .login-card .subtitle {
            color: rgba(255, 255, 255, 0.5);
            text-align: center;
            font-size: 0.875rem;
            margin-bottom: 1.8rem;
        }

        .form-label {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.8rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.4rem;
        }

        .input-group-text {
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-right: none;
            color: rgba(255, 255, 255, 0.5);
        }

        .form-control {
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-left: none;
            color: #fff;
            padding: 0.7rem 0.9rem;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(102, 126, 234, 0.6);
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.15);
            color: #fff;
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.3);
        }

        .input-group:focus-within .input-group-text {
            border-color: rgba(102, 126, 234, 0.6);
            color: #667eea;
        }

        .form-check-input {
            background-color: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.2);
        }

        .form-check-input:checked {
            background-color: #667eea;
            border-color: #667eea;
        }

        .form-check-label {
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.85rem;
        }

        .btn-login {
            background: linear-gradient(135deg, #667eea, #764ba2);
            border: none;
            padding: 0.75rem;
            font-weight: 600;
            font-size: 1rem;
            border-radius: 10px;
            color: #fff;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.45);
            color: #fff;
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .forgot-link {
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.85rem;
            text-decoration: none;
            transition: color 0.3s;
        }

        .forgot-link:hover {
            color: #667eea;
        }

        .alert-danger {
            background: rgba(220, 53, 69, 0.15);
            border: 1px solid rgba(220, 53, 69, 0.3);
            color: #ff6b7a;
            border-radius: 10px;
            font-size: 0.85rem;
        }

        .text-danger {
            font-size: 0.8rem;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-icon">
                <i class="bi bi-shield-lock"></i>
            </div>
            <h2>Đăng nhập</h2>
            <p class="subtitle">Truy cập hệ thống quản trị</p>

            {{-- Hiển thị thông báo lỗi --}}
            <x-admin.alert></x-admin.alert>

            <form action="{{ route('admin.login.post') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="f-username" class="form-label">Tên đăng nhập</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                        <input type="text" class="form-control" id="f-username" placeholder="Nhập username"
                            name="username" value="{{ old('username') }}">
                    </div>
                    @error('username')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="f-password" class="form-label">Mật khẩu</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input type="password" class="form-control" id="f-password" placeholder="Nhập mật khẩu"
                            name="password" value="{{ old('password') }}">
                    </div>
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember">
                        <label class="form-check-label" for="remember">Ghi nhớ đăng nhập</label>
                    </div>
                    <a href="{{ route('admin.forgotpass') }}" class="forgot-link">Quên mật khẩu?</a>
                </div>

                <button type="submit" class="btn btn-login w-100">
                    <i class="bi bi-box-arrow-in-right me-1"></i> Đăng nhập
                </button>
            </form>
        </div>
    </div>
</body>

</html>
