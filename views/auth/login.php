<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Đăng nhập</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            height: 100vh;
            margin: 0;

            /* Ảnh nền */
            background: url('https://images.unsplash.com/photo-1619566636858-adf3ef46400b') no-repeat center center/cover;

            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        /* lớp phủ mờ */
        body::before {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.4);
        }

        .login-box,
        .register-box {
            position: relative;
            z-index: 2;

            width: 400px;
            background: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(5px);
        }

        h3 {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

    <div class="login-box">
        <h3>🍎 Đăng nhập</h3>

        <form action="?act=handle_login" method="POST">

            <div class="input-group mb-3">
                <span class="input-group-text">
                    <i class="fa fa-envelope"></i>
                </span>
                <input type="email" name="email" class="form-control" placeholder="Email">
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text">
                    <i class="fa fa-lock"></i>
                </span>
                <input type="password" name="password" class="form-control" placeholder="Mật khẩu">
            </div>

            <button class="btn btn-success w-100">Đăng nhập</button>

        </form>

        <p class="mt-3 text-center">
            Chưa có tài khoản?
            <a href="?act=register">Đăng ký</a>
        </p>
    </div>

</body>

</html>