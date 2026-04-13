<h3 class="mb-4 text-center">📦 Đơn hàng của bạn</h3>

<style>
    .order-card {
        border-radius: 12px;
        transition: 0.3s;
    }

    .order-card:hover {
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    }

    .tracking {
        display: flex;
        justify-content: space-between;
        margin-top: 15px;
    }

    .step {
        width: 100%;
        text-align: center;
        position: relative;
        font-size: 14px;
    }

    .step::before {
        content: "";
        display: block;
        height: 4px;
        background: #ddd;
        position: absolute;
        top: 10px;
        left: -50%;
        width: 100%;
        z-index: 0;
    }

    .step:first-child::before {
        display: none;
    }

    .circle {
        width: 25px;
        height: 25px;
        border-radius: 50%;
        background: #ccc;
        margin: auto;
        line-height: 25px;
        color: white;
        position: relative;
        z-index: 1;
    }

    /* ACTIVE */
    .active .circle {
        background: #28a745;
    }

    .active p {
        color: #28a745;
        font-weight: bold;
    }

    /* CANCELLED */
    .cancelled .circle {
        background: #dc3545;
    }

    .cancelled p {
        color: #dc3545;
        font-weight: bold;
    }
</style>

<?php foreach ($orders as $o): ?>

    <?php
    // ===== MAP STATUS =====
    $statusMap = [
        'pending' => 0,
        'processing' => 1,
        'shipping' => 2,
        'completed' => 3
    ];

    $currentStep = $statusMap[$o['status']] ?? 0;

    // check huỷ đơn
    $isCancelled = ($o['status'] == 'cancelled');

    // label status
    $statusText = [
        'pending' => 'Chờ xử lý',
        'processing' => 'Đang xử lý',
        'shipping' => 'Đang giao',
        'completed' => 'Hoàn thành',
        'cancelled' => 'Đã huỷ'
    ];
    ?>

    <div class="card order-card mb-4 shadow-sm">
        <div class="card-body">

            <!-- INFO -->
            <div class="d-flex justify-content-between">
                <div>
                    <b>Đơn #<?= $o['id'] ?></b><br>
                    <small><?= date('d/m/Y H:i', strtotime($o['created_at'])) ?></small>
                </div>

                <div class="text-end">
                    <b class="<?= $isCancelled ? 'text-muted' : 'text-danger' ?>">
                        <?= number_format($o['total_price']) ?>đ
                    </b><br>

                    <span class="badge bg-<?=
                                            $o['status'] == 'pending' ? 'secondary' : ($o['status'] == 'processing' ? 'info' : ($o['status'] == 'shipping' ? 'primary' : ($o['status'] == 'completed' ? 'success' : 'danger')))
                                            ?>">
                        <?= $statusText[$o['status']] ?? 'Không rõ' ?>
                    </span>
                </div>
            </div>

            <!-- TRACKING -->
            <div class="tracking">

                <?php
                $steps = [
                    0 => 'Chờ xử lý',
                    1 => 'Đang xử lý',
                    2 => 'Đang giao',
                    3 => 'Hoàn thành'
                ];

                foreach ($steps as $key => $label):

                    // nếu huỷ đơn => đỏ hết
                    if ($isCancelled) {
                        $class = 'cancelled';
                    } else {
                        $class = ($currentStep >= $key) ? 'active' : '';
                    }
                ?>
                    <div class="step <?= $class ?>">
                        <div class="circle"><?= $key + 1 ?></div>
                        <p><?= $label ?></p>
                    </div>
                <?php endforeach; ?>

            </div>

            <!-- ACTION -->
            <div class="d-flex justify-content-between align-items-center mt-3">

                <!-- NÚT XEM CHI TIẾT -->
                <a href="?act=order_detail&id=<?= $o['id'] ?>" class="btn btn-sm btn-info">
                    🔍 Xem chi tiết
                </a>

                <!-- NÚT ĐÃ NHẬN HÀNG -->
                <?php if ($o['status'] == 'shipping'): ?>
                    <a href="?act=complete_order&id=<?= $o['id'] ?>"
                        onclick="return confirm('Xác nhận đã nhận hàng?')"
                        class="btn btn-success btn-sm">
                        ✔ Đã nhận hàng
                    </a>
                <?php endif; ?>

            </div>


        </div>
    </div>

<?php endforeach; ?>