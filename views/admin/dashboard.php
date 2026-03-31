<?php 
if (session_status() === PHP_SESSION_NONE) { 
    session_start();
}
?>
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
body { display: flex; min-height: 100vh; margin: 0; }

/* Sidebar */
#sidebar { min-width: 250px; background: #343a40; color: #fff; }
#sidebar h3 { text-align: center; padding: 12px 0; border-bottom: 1px solid #495057; }
#sidebar a { color: #fff; display: block; padding: 12px 20px; text-decoration: none; }
#sidebar a:hover { background: #495057; }
#sidebar a.active { background: #6c757d; }

/* Content */
#content { flex: 1; padding: 20px; padding-bottom: 60px; background: #f8f9fa; }

/* Topbar */
.topbar {
    height: 60px; background: #fff;
    display: flex; justify-content: space-between; align-items: center;
    padding: 0 20px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    margin-bottom: 20px;
}

/* Cards */
.card-stats {
    padding: 20px;
    border-radius: 8px;
    color: #fff;
    text-align: center;
}

.bg-blue { background: #0d6efd; }
.bg-green { background: #198754; }
.bg-yellow { background: #ffc107; color:#000; }
.bg-red { background: #dc3545; }

/* Footer */
footer {
    position: fixed;
    bottom: 0;
    width: 100%;
    background: #fff;
    text-align: center;
    padding: 10px;
}
</style>
</head>

<body>

<!-- Sidebar -->
<div id="sidebar">
<h3>Fruit Admin</h3>
<a href="?act=dashboard" class="active"><i class="fa-solid fa-chart-line"></i> Dashboard</a>
<a href="?act=product"><i class="fa-solid fa-apple-whole"></i> Sản phẩm</a>
<a href="?act=category"><i class="fa-solid fa-list"></i> Danh mục</a>
<a href="?act=customer"><i class="fa-solid fa-users"></i> Khách hàng</a>
<a href="?act=order"><i class="fa-solid fa-cart-shopping"></i> Đơn hàng</a>
<a href="?act=logout"><i class="fa-solid fa-right-from-bracket"></i> Đăng xuất</a>
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

<h3><i class="fa-solid fa-chart-line"></i> Dashboard</h3>

<!-- Stats -->
<div class="row">
<div class="col-md-3">
    <div class="card-stats bg-blue">
        <h4>Sản phẩm</h4>
        <p><?= $totalProducts ?? 0 ?></p>
    </div>
</div>

<div class="col-md-3">
    <div class="card-stats bg-green">
        <h4>Khách hàng</h4>
        <p><?= $totalCustomers ?? 0 ?></p>
    </div>
</div>

<div class="col-md-3">
    <div class="card-stats bg-yellow">
        <h4>Đơn hàng</h4>
        <p><?= $totalOrders ?? 0 ?></p>
    </div>
</div>

<div class="col-md-3">
    <div class="card-stats bg-red">
        <h4>Doanh thu</h4>
        <p><?= number_format($totalRevenue ?? 0,0,',','.') ?>₫</p>
    </div>
</div>
</div>

<!-- Chart -->
<div class="mt-5">
<h4>Doanh thu theo sản phẩm</h4>
<canvas id="revenueChart" height="100"></canvas>
</div>

</div>

<footer>© 2025 Fruit Store</footer>

<script>
const ctx = document.getElementById('revenueChart').getContext('2d');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?= json_encode($chartLabels ?? []) ?>,
        datasets: [{
            label: 'Doanh thu',
            data: <?= json_encode($chartValues ?? []) ?>,
            backgroundColor: 'rgba(25, 135, 84, 0.7)'
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    callback: val => val.toLocaleString('vi-VN') + '₫'
                }
            }
        }
    }
});
</script>

</body>
</html>