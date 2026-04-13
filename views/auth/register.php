<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Đăng ký</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            height: 100vh;
            margin: 0;

            /* Ảnh nền */
            background: url('https://images.unsplash.com/photo-1464965911861-746a04b4bca6') no-repeat center center/cover;

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

    <div class="register-box">
        <h3>📝 Đăng ký</h3>

        <form action="?act=handle_register" method="POST">

            <div class="mb-3">
                <input type="text" name="full_name" class="form-control" placeholder="Họ tên">
            </div>

            <div class="mb-3">
                <input type="email" name="email" class="form-control" placeholder="Email">
            </div>

            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="Mật khẩu">
            </div>

            <button class="btn btn-primary w-100">Đăng ký</button>

        </form>

        <p class="mt-3 text-center">
            Đã có tài khoản?
            <a href="?act=login">Đăng nhập</a>
        </p>
    </div>

</body>

</html>