<!DOCTYPE html>
<html>
<head>
    <title>🍉 FRESTY Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<nav class="navbar navbar-dark bg-success px-3">
    <a class="navbar-brand" href="?act=home">🍉 FRESTY Shop</a>

    <div>
        <a href="?act=cart" class="btn btn-warning">🛒 Giỏ hàng</a>

        <?php if(isset($_SESSION['user'])): ?>
            <a href="?act=orders" class="btn btn-light">Đơn hàng</a>
            <a href="?act=logout" class="btn btn-danger">Đăng xuất</a>
        <?php else: ?>
            <a href="?act=login" class="btn btn-light">Đăng nhập</a>
        <?php endif; ?>
    </div>
</nav>

<div class="container mt-4">
    <?php include $view; ?>
</div>

</body>
</html>