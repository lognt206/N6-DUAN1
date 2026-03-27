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
<title>Admin - Cửa hàng trái cây</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
body { display: flex; min-height: 100vh; margin: 0; font-family: Arial; }
#sidebar { width: 250px; background: #198754; color: #fff; }
#sidebar h3 { text-align: center; padding: 15px; }
#sidebar a { display: block; color: #fff; padding: 12px 20px; text-decoration: none; }
#sidebar a:hover { background: #157347; }

#content { flex: 1; padding: 20px; background: #f8f9fa; }

.topbar {
    background: #fff;
    padding: 10px 20px;
    display: flex;
    justify-content: space-between;
    margin-bottom: 20px;
}

.card-stats {
    padding: 20px;
    border-radius: 8px;
    color: #fff;
    text-align: center;
}
</style>
</head>

<body>

<!-- SIDEBAR -->
<div id="sidebar">
    <h3>🍎 Fruit Admin</h3>
    <a href="?act=dashboard"><i class="fa fa-home"></i> Dashboard</a>
    <a href="?act=product"><i class="fa fa-apple-whole"></i> Sản phẩm</a>
</div>

<!-- CONTENT -->
<div id="content">

<div class="topbar">
    <h4>Quản lý cửa hàng trái cây</h4>
    <div>
        👤 <?= $_SESSION['user']['full_name'] ?? 'Admin' ?>
        <a href="?act=login" class="btn btn-sm btn-danger">Logout</a>
    </div>
</div>

<!-- STATS -->
<div class="row">
    <div class="col-md-3">
        <div class="card-stats bg-primary">
            <h5>Tổng sản phẩm</h5>
            <h3><?= $totalProducts ?? 10 ?></h3>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card-stats bg-success">
            <h5>Khách hàng</h5>
            <h3><?= $totalUsers ?? 5 ?></h3>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card-stats bg-warning">
            <h5>Đơn hàng</h5>
            <h3><?= $totalOrders ?? 8 ?></h3>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card-stats bg-danger">
            <h5>Doanh thu</h5>
            <h3><?= number_format($totalRevenue ?? 2000000) ?>₫</h3>
        </div>
    </div>
</div>

<!-- CHART -->
<div class="mt-5">
    <h4>Doanh thu theo sản phẩm</h4>
    <canvas id="chart"></canvas>
</div>

</div>

<script>
const ctx = document.getElementById('chart');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?= json_encode($chartLabels ?? ['Táo','Chuối','Cam']) ?>,
        datasets: [{
            label: 'Doanh thu',
            data: <?= json_encode($chartValues ?? [500000,700000,300000]) ?>,
            backgroundColor: 'rgba(25, 135, 84, 0.7)'
        }]
    }
});
</script>

</body>
</html>
