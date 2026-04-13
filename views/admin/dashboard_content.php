<h3 class="mb-4"><i class="fa-solid fa-chart-line"></i> Dashboard</h3>

<!-- ===== CARDS ===== -->
<div class="row g-3 mb-4">

    <div class="col-md-3">
        <div class="card-stats bg-blue shadow">
            <i class="fa-solid fa-box fa-2x mb-2"></i>
            <h6>Sản phẩm</h6>
            <h3><?= $totalProducts ?></h3>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card-stats bg-green shadow">
            <i class="fa-solid fa-users fa-2x mb-2"></i>
            <h6>Khách hàng</h6>
            <h3><?= $totalCustomers ?></h3>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card-stats bg-yellow shadow">
            <i class="fa-solid fa-cart-shopping fa-2x mb-2"></i>
            <h6>Đơn hàng</h6>
            <h3><?= $totalOrders ?></h3>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card-stats bg-red shadow">
            <i class="fa-solid fa-money-bill fa-2x mb-2"></i>
            <h6>Doanh thu</h6>
            <h3><?= number_format($totalRevenue, 0, ',', '.') ?>đ</h3>
        </div>
    </div>

</div>

<!-- ===== CHART ===== -->
<div class="card shadow mb-4">
    <div class="card-body">
        <h5><i class="fa-solid fa-chart-column"></i> Doanh thu theo tháng</h5>
        <canvas id="revenueChart" height="100"></canvas>
    </div>
</div>

<div class="row">

    <!-- ===== ĐƠN HÀNG ===== -->
    <div class="col-md-7">
        <div class="card shadow">
            <div class="card-body">
                <h5><i class="fa-solid fa-receipt"></i> Đơn hàng mới nhất</h5>

                <table class="table table-hover mt-3">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Khách</th>
                            <th>Tổng tiền</th>
                            <th>Trạng thái</th>
                            <th>Ngày</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($latestOrders as $o): ?>
                            <tr>
                                <td>#<?= $o['id'] ?></td>

                                <!-- 🔥 QUAN TRỌNG -->
                                <td><?= $o['display_name'] ?></td>

                                <td>
                                    <b><?= number_format($o['total_price'], 0, ',', '.') ?>đ</b>
                                </td>

                                <td>
                                    <?php
                                    switch ($o['status']) {
                                        case 'pending':
                                            echo '<span class="badge bg-secondary">Chờ xử lý</span>';
                                            break;
                                        case 'processing':
                                            echo '<span class="badge bg-warning text-dark">Đang xử lý</span>';
                                            break;
                                        case 'shipping':
                                            echo '<span class="badge bg-info text-dark">Đang giao</span>';
                                            break;
                                        case 'completed':
                                            echo '<span class="badge bg-success">Hoàn thành</span>';
                                            break;
                                        case 'cancel':
                                            echo '<span class="badge bg-danger">Đã hủy</span>';
                                            break;
                                        default:
                                            echo '<span class="badge bg-dark">Không xác định</span>';
                                    }
                                    ?>
                                </td>

                                <td><?= date('d/m/Y H:i', strtotime($o['created_at'])) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>

    <!-- ===== TOP PRODUCT ===== -->
    <div class="col-md-5">
        <div class="card shadow">
            <div class="card-body">
                <h5><i class="fa-solid fa-fire"></i> Sản phẩm bán chạy</h5>

                <ul class="list-group mt-3">
                    <?php foreach ($topProducts as $p): ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?= $p['name'] ?>
                            <span class="badge bg-primary"><?= $p['sold'] ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>

            </div>
        </div>
    </div>

</div>