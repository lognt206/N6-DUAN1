<h3><i class="fa-solid fa-chart-line"></i> Dashboard</h3>

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

<div class="mt-5">
    <h4>Doanh thu theo sản phẩm</h4>
    <canvas id="revenueChart" height="100"></canvas>
</div>