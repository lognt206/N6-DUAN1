<div class="card shadow-sm p-4">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">📄 Chi tiết đơn #<?= $order['id'] ?></h4>

        <?php
        $statusText = [
            'pending' => 'Chờ xử lý',
            'processing' => 'Đang xử lý',
            'shipping' => 'Đang giao',
            'completed' => 'Hoàn thành',
            'cancelled' => 'Đã huỷ'
        ];

        $statusColor = [
            'pending' => 'secondary',
            'processing' => 'info',
            'shipping' => 'primary',
            'completed' => 'success',
            'cancelled' => 'danger'
        ];
        ?>

        <span class="badge bg-<?= $statusColor[$order['status']] ?? 'dark' ?> px-3 py-2">
            <?= $statusText[$order['status']] ?? 'Không rõ' ?>
        </span>
    </div>

    <hr>

    <!-- INFO -->
    <div class="mb-3">
        <p class="mb-1">🕒 <b>Ngày:</b> <?= date('d/m/Y H:i', strtotime($order['created_at'] ?? 'now')) ?></p>

        <!-- FIX NGƯỜI NHẬN -->
        <p class="mb-1">
            <b>👤 Người nhận:</b> 
            <?= $order['customer_name'] ?? $order['display_name'] ?? '---' ?>
        </p>

        <p class="mb-1">📞 <b>SĐT:</b> <?= $order['phone'] ?></p>
        <p class="mb-0">📍 <b>Địa chỉ:</b> <?= $order['address'] ?></p>
    </div>

    <!-- TABLE -->
    <div class="table-responsive">
        <table class="table align-middle">

            <thead class="table-light">
                <tr>
                    <th style="width:50%">Sản phẩm</th>
                    <th>Giá</th>
                    <th>SL</th>
                    <th class="text-end">Thành tiền</th>
                </tr>
            </thead>

            <tbody>
                <?php $total = 0; ?>

                <?php foreach ($items as $i):
                    $thanhtien = $i['price'] * $i['quantity'];
                    $total += $thanhtien;

                    $img = !empty($i['image'])
                        ? "/N6-DUAN1/uploads/" . $i['image']
                        : "https://via.placeholder.com/70";
                ?>

                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-3">

                                <!-- ẢNH -->
                                <img src="<?= $img ?>"
                                    onclick="openImage(this.src)"
                                    style="width:70px;height:70px;object-fit:cover;border-radius:10px;cursor:pointer;"
                                    onerror="this.src='https://via.placeholder.com/70'">

                                <!-- INFO -->
                                <div>
                                    <div class="fw-bold"><?= $i['name'] ?></div>
                                    <?php if (!empty($i['description'])): ?>
                                        <small class="text-muted"><?= $i['description'] ?></small>
                                    <?php endif; ?>
                                </div>

                            </div>
                        </td>

                        <td class="text-danger fw-semibold">
                            <?= number_format($i['price']) ?>đ
                        </td>

                        <td><?= $i['quantity'] ?></td>

                        <td class="text-danger fw-bold text-end">
                            <?= number_format($thanhtien) ?>đ
                        </td>
                    </tr>

                <?php endforeach; ?>
            </tbody>

        </table>
    </div>

    <!-- TOTAL -->
    <div class="text-end mt-3">
        <h5 class="text-danger fw-bold">
            Tổng: <?= number_format($total) ?>đ
        </h5>
    </div>

</div>

<!-- 🔥 POPUP ẢNH -->
<div id="imgModal" onclick="closeImage()">
    <img id="imgPreview">
</div>

<style>
    #imgModal {
        display: none;
        position: fixed;
        z-index: 9999;
        inset: 0;
        background: rgba(0, 0, 0, 0.8);
        justify-content: center;
        align-items: center;
    }

    #imgModal img {
        max-width: 80%;
        max-height: 80%;
        border-radius: 12px;
    }
</style>

<script>
    function openImage(src) {
        document.getElementById("imgModal").style.display = "flex";
        document.getElementById("imgPreview").src = src;
    }

    function closeImage() {
        document.getElementById("imgModal").style.display = "none";
    }
</script>