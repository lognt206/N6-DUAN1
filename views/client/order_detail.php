<style>
    .order-detail-card {
        border-radius: 12px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        padding: 20px;
        background: #fff;
    }

    .product-item {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .product-item img {
        width: 70px;
        height: 70px;
        object-fit: cover;
        border-radius: 10px;
        cursor: pointer;
        transition: 0.2s;
    }

    .product-item img:hover {
        transform: scale(1.05);
    }

    .total-box {
        font-size: 20px;
        font-weight: bold;
    }

    /* POPUP */
    #imgModal {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.8);
        z-index: 9999;
        justify-content: center;
        align-items: center;
    }

    #imgModal img {
        max-width: 80%;
        max-height: 80%;
        border-radius: 12px;
    }
</style>

<div class="order-detail-card">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-3">
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
    <div class="mb-3">
        <p><b>🕒 Ngày:</b> <?= date('d/m/Y H:i', strtotime($order['created_at'])) ?></p>
        <p><b>👤 Người nhận:</b> <?= $order['customer_name'] ?? '---' ?></p>
        <p><b>📞 SĐT:</b> <?= $order['phone'] ?></p>
        <p><b>📍 Địa chỉ:</b> <?= $order['address'] ?></p>
    </div>

    <!-- LIST -->
    <div class="table-responsive">
        <table class="table align-middle">
            <thead class="table-light">
                <tr>
                    <th class="text-start">Sản phẩm</th>
                    <th>Giá</th>
                    <th>SL</th>
                    <th class="text-end">Thành tiền</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($items as $i): 
                    $img = !empty($i['image'])
                        ? "/N6-DUAN1/uploads/" . $i['image']
                        : "https://via.placeholder.com/70";
                ?>

                <tr>
                    <td class="text-start">
                        <div class="product-item">
                            <img src="<?= $img ?>"
                                 onclick="openImage(this.src)"
                                 onerror="this.src='https://via.placeholder.com/70'">

                            <div>
                                <div class="fw-semibold"><?= $i['name'] ?></div>
                                <small class="text-muted">
                                    <?= $i['description'] ?? '' ?>
                                </small>
                            </div>
                        </div>
                    </td>

                    <td class="text-danger">
                        <?= number_format($i['price']) ?>đ
                    </td>

                    <td><?= $i['quantity'] ?></td>

                    <td class="text-end text-danger fw-bold">
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

<!-- POPUP -->
<div id="imgModal" onclick="closeImage()">
    <img id="imgPreview">
</div>

<script>
function openImage(src) {
    document.getElementById("imgModal").style.display = "flex";
    document.getElementById("imgPreview").src = src;
}
function closeImage() {
    document.getElementById("imgModal").style.display = "none";
}
</script>