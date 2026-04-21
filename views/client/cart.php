<h3 class="mb-3">🛒 Giỏ hàng</h3>

<div class="row">

    <!-- LEFT -->
    <div class="col-md-8">

        <?php if (empty($_SESSION['cart'])): ?>
            <div class="alert alert-info">Giỏ hàng đang trống</div>
        <?php else: ?>

            <?php foreach ($_SESSION['cart'] as $id => $item):
                $unit = $item['unit'] ?? 'trái';
                $qty  = $item['quantity'];
                $price = $item['price'];
                $sum = $price * $qty;

                $step = ($unit == 'kg') ? 0.1 : 1;
                $min  = ($unit == 'kg') ? 0.1 : 1;

                // ✅ FIX IMAGE
                $img = !empty($item['image'])
                    ? "http://localhost/N6-DUAN1/uploads/" . $item['image']
                    : "https://via.placeholder.com/70";
            ?>
                

                <div class="card mb-3 border-0 shadow-sm rounded-4 p-2">
                    <div class="d-flex align-items-center justify-content-between">

                        <!-- IMAGE + INFO -->
                        <div class="d-flex align-items-center" style="width:45%;">
                            <img src="<?= $img ?>"
                                onerror="this.src='https://via.placeholder.com/70'"
                                style="width:70px;height:70px;object-fit:cover;border-radius:10px;margin-right:12px;">

                            <div>
                                <div class="fw-semibold"><?= $item['name'] ?></div>
                                <small class="text-danger">
                                    <?= number_format($price) ?>đ / <?= $unit ?>
                                </small>
                            </div>
                        </div>

                        <!-- QUANTITY -->
                        <div class="d-flex align-items-center border rounded-pill px-2 py-1">

                            <button class="btn btn-sm"
                                onclick="updateQty(<?= $id ?>, -<?= $step ?>)"
                                <?= $qty <= $min ? 'disabled' : '' ?>>
                                −
                            </button>

                            <input type="number"
                                id="qty-<?= $id ?>"
                                value="<?= $qty ?>"
                                min="<?= $min ?>"
                                step="<?= $step ?>"
                                class="form-control border-0 text-center"
                                style="width:60px"
                                onchange="updateQtyDirect(<?= $id ?>)">

                            <button class="btn btn-sm"
                                onclick="updateQty(<?= $id ?>, <?= $step ?>)">
                                +
                            </button>
                        </div>

                        <!-- TOTAL -->
                        <div class="text-danger fw-bold" style="width:120px;text-align:right;">
                            <?= number_format($sum) ?>đ
                        </div>

                        <!-- REMOVE -->
                        <a href="?act=cart_remove&id=<?= $id ?>"
                            class="btn btn-danger btn-sm rounded-circle"
                            style="width:32px;height:32px;">
                            ×
                        </a>

                    </div>
                </div>

            <?php endforeach; ?>
        <?php endif; ?>

    </div>

    <!-- RIGHT -->
    <div class="col-md-4">

        <?php
        $total = 0;
        foreach ($_SESSION['cart'] ?? [] as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        ?>

        <div class="card shadow rounded-4">
            <div class="card-body">

                <h5 class="mb-2">Tổng thanh toán</h5>

                <h3 class="text-danger fw-bold">
                    <?= number_format($total) ?>đ
                </h3>

                <a href="?act=checkout"
                    class="btn btn-success w-100 mt-3 <?= empty($_SESSION['cart']) ? 'disabled' : '' ?>">
                    Thanh toán
                </a>

                <a href="?act=home"
                    class="btn btn-outline-secondary w-100 mt-2">
                    ← Tiếp tục mua
                </a>

            </div>
        </div>

    </div>
</div>
<script>
    function updateQty(id, change) {
        let input = document.getElementById('qty-' + id);
        let value = parseFloat(input.value);
        let min = parseFloat(input.min);

        value = value + change;

        if (value < min) value = min;

        // ✅ FIX FLOAT
        value = Math.round(value * 10) / 10;

        window.location.href = `?act=cart_update&id=${id}&quantity=${value}`;
    }

    function updateQtyDirect(id) {
        let input = document.getElementById('qty-' + id);
        let value = parseFloat(input.value);
        let min = parseFloat(input.min);

        if (value < min) value = min;

        value = Math.round(value * 10) / 10;

        window.location.href = `?act=cart_update&id=${id}&quantity=${value}`;
    }
</script>