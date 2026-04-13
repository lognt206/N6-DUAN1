<style>
    .order-detail-card {
        border-radius: 12px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.08);
        padding: 20px;
        background: #fff;
    }

    .order-header {
        border-bottom: 1px solid #eee;
        margin-bottom: 15px;
        padding-bottom: 10px;
    }

    .order-info p {
        margin: 5px 0;
    }

    .table thead {
        background: #f8f9fa;
    }

    .table tbody tr:hover {
        background: #f1f3f5;
    }

    .total-box {
        font-size: 20px;
        font-weight: bold;
    }
</style>

<div class="order-detail-card">

    <!-- HEADER -->
    <div class="order-header d-flex justify-content-between align-items-center">
        <h4>📄 Chi tiết đơn #<?= $order['id'] ?></h4>

        <?php
        $statusText = [
            'pending' => 'Chờ xử lý',
            'processing' => 'Đang xử lý',
            'shipping' => 'Đang giao',
            'completed' => 'Hoàn thành',
            'cancelled' => 'Đã huỷ'
        ];
        ?>

        <span class="badge bg-<?=
            $order['status']=='pending'?'secondary':
            ($order['status']=='processing'?'info':
            ($order['status']=='shipping'?'primary':
            ($order['status']=='completed'?'success':'danger')))
        ?>">
            <?= $statusText[$order['status']] ?? 'Không rõ' ?>
        </span>
    </div>

    <!-- INFO -->
    <div class="order-info mb-3">
        <p><b>🕒 Ngày:</b> <?= date('d/m/Y H:i', strtotime($order['created_at'])) ?></p>
        <p><b>👤 Người nhận:</b> <?= $order['customer_name'] ?></p>
        <p><b>📞 SĐT:</b> <?= $order['phone'] ?></p>
        <p><b>📍 Địa chỉ:</b> <?= $order['address'] ?></p>
    </div>

    <!-- TABLE -->
    <div class="table-responsive">
        <table class="table table-bordered align-middle text-center">
            <thead>
                <tr>
                    <th class="text-start">Sản phẩm</th>
                    <th>Giá</th>
                    <th>SL</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $i): ?>
                <tr>
                    <td class="text-start"><?= $i['name'] ?></td>
                    <td><?= number_format($i['price']) ?>đ</td>
                    <td><?= $i['quantity'] ?></td>
                    <td class="text-danger fw-bold">
                        <?= number_format($i['price'] * $i['quantity']) ?>đ
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- TOTAL -->
    <div class="d-flex justify-content-between align-items-center mt-3">
        <a href="?act=orders" class="btn btn-outline-secondary">
            ← Quay lại
        </a>

        <div class="total-box text-danger">
            Tổng: <?= number_format($order['total_price']) ?>đ
        </div>
    </div>

</div>