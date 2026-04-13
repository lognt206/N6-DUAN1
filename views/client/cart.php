<h3 class="mb-3">🛒 Giỏ hàng</h3>

<div class="row">
    
    <!-- LEFT: DANH SÁCH -->
    <div class="col-md-8">

        <?php foreach ($_SESSION['cart'] ?? [] as $id => $item): 
            $sum = $item['price'] * $item['quantity'];
        ?>

        <div class="card mb-3 shadow-sm">
            <div class="card-body d-flex justify-content-between align-items-center">

                <!-- INFO -->
                <div>
                    <h5><?= $item['name'] ?></h5>
                    <p class="text-danger mb-1">
                        <?= number_format($item['price']) ?>đ
                    </p>
                </div>

                <!-- QUANTITY -->
                <form method="post" action="?act=cart_update" class="d-flex align-items-center">
                    <input type="hidden" name="id" value="<?= $id ?>">

                    <button name="quantity" value="<?= $item['quantity'] - 1 ?>" 
                            class="btn btn-outline-secondary btn-sm">-</button>

                    <span class="mx-2"><?= $item['quantity'] ?></span>

                    <button name="quantity" value="<?= $item['quantity'] + 1 ?>" 
                            class="btn btn-outline-secondary btn-sm">+</button>
                </form>

                <!-- TOTAL -->
                <div>
                    <b><?= number_format($sum) ?>đ</b>
                </div>

                <!-- REMOVE -->
                <a href="?act=cart_remove&id=<?= $id ?>" 
                   class="btn btn-danger btn-sm">
                    X
                </a>

            </div>
        </div>

        <?php endforeach; ?>

    </div>

    <!-- RIGHT: THANH TOÁN -->
    <div class="col-md-4">

        <div class="card shadow">
            <div class="card-body">

                <?php 
                $total = 0;
                foreach ($_SESSION['cart'] ?? [] as $item) {
                    $total += $item['price'] * $item['quantity'];
                }
                ?>

                <h5>Tổng thanh toán</h5>

                <h3 class="text-danger">
                    <?= number_format($total) ?>đ
                </h3>

                <a href="?act=checkout" class="btn btn-success w-100 mt-3">
                    Thanh toán
                </a>

                <a href="?act=home" class="btn btn-outline-secondary w-100 mt-2">
                    ← Tiếp tục mua
                </a>

            </div>
        </div>

    </div>

</div>