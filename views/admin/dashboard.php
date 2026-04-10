<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<?php $act = $_GET['act'] ?? 'dashboard'; ?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fruit Admin Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body {
            display: flex;
            min-height: 100vh;
            margin: 0;
        }

        /* Sidebar */
        #sidebar {
            min-width: 250px;
            background: #343a40;
            color: #fff;
        }

        #sidebar h3 {
            text-align: center;
            padding: 12px 0;
            border-bottom: 1px solid #495057;
        }

        #sidebar a {
            color: #fff;
            display: block;
            padding: 12px 20px;
            text-decoration: none;
        }

        #sidebar a:hover {
            background: #495057;
        }

        #sidebar a.active {
            background: #6c757d;
        }

        /* Content */
        #content {
            flex: 1;
            padding: 20px;
            width: 100%;
            max-width: 100%;
        }

        /* Topbar */
        .topbar {
            height: 60px;
            background: #fff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        /* Cards */
        .card-stats {
            padding: 20px;
            border-radius: 8px;
            color: #fff;
            text-align: center;
        }

        .bg-blue {
            background: #0d6efd;
        }

        .bg-green {
            background: #198754;
        }

        .bg-yellow {
            background: #ffc107;
            color: #000;
        }

        .bg-red {
            background: #dc3545;
        }

        /* Footer */
        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background: #fff;
            text-align: center;
            padding: 10px;
        }

        img {
            max-width: 100%;
            height: auto;
            object-fit: cover;
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <div id="sidebar">
        <h3>Fruit Admin</h3>
        <a href="?act=dashboard" class="<?= $act == 'dashboard' ? 'active' : '' ?>">
            <i class="fa-solid fa-chart-line"></i> Dashboard
        </a>

        <a href="?act=product" class="<?= str_contains($act, 'product') ? 'active' : '' ?>">
            <i class="fa-solid fa-apple-whole"></i> Sản phẩm
        </a>

        <a href="?act=category" class="<?= str_contains($act, 'category') ? 'active' : '' ?>">
            <i class="fa-solid fa-list"></i> Danh mục
        </a>

        <a href="?act=customer" class="<?= str_contains($act, 'customer') ? 'active' : '' ?>">
            <i class="fa-solid fa-users"></i> Khách hàng
        </a>

        <a href="?act=order" class="<?= str_contains($act, 'order') ? 'active' : '' ?>">
            <i class="fa-solid fa-cart-shopping"></i> Đơn hàng
        </a>
    </div>

    <!-- Content -->
    <div id="content">

        <div class="topbar">
            <strong><i class="fa-solid fa-apple-whole"></i> Fruit Admin</strong>
            <div>
                <img src="uploads/logo.png" width="40" style="border-radius:50%">
                <?= $_SESSION['user']['full_name'] ?? '' ?>
                <a href="?act=logout" class="btn btn-sm btn-outline-danger ms-2">Đăng xuất</a>
            </div>
        </div>

        <?php include $view; ?>

    </div>

    <footer>© 2025 Fruit Store</footer>

    <script>
        const canvas = document.getElementById('revenueChart');

        if (canvas) {
            const ctx = canvas.getContext('2d');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: <?= json_encode($chartLabels ?? []) ?>,
                    datasets: [{
                        label: 'Doanh thu',
                        data: <?= json_encode($chartValues ?? []) ?>,
                        backgroundColor: 'rgba(25, 135, 84, 0.7)'
                    }]
                }
            });
        }
    </script>

</body>

</html>