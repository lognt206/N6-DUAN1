<h3 class="mb-4 text-center">🍓 Sản phẩm nổi bật</h3>

<!-- ✅ THÔNG BÁO -->
<?php if(isset($_GET['msg'])): ?>
    <div class="alert alert-success text-center">
        ✅ Đã thêm vào giỏ hàng
    </div>
<?php endif; ?>

<div class="row g-4">
<?php foreach ($products as $p): ?>
    <div class="col-md-3">

        <div class="card h-100 shadow-sm border-0 product-card">

            <!-- IMAGE -->
            <div class="position-relative">
                <img src="uploads/<?= $p['image'] ?>" 
                     class="card-img-top"
                     style="height:200px; object-fit:cover;">

                <!-- BADGE -->
                <span class="badge bg-danger position-absolute top-0 start-0 m-2">
                    HOT
                </span>
            </div>

            <!-- BODY -->
            <div class="card-body text-center">

                <h6 class="fw-bold"><?= $p['name'] ?></h6>

                <p class="text-danger fs-5 mb-2">
                    <?= number_format($p['price']) ?>đ
                </p>

                <a href="?act=add_cart&id=<?= $p['id'] ?>" 
                   class="btn btn-success w-100">
                    🛒 Thêm giỏ
                </a>

            </div>

        </div>

    </div>
<?php endforeach; ?>
</div>

<!-- STYLE -->
<style>
.product-card {
    transition: 0.3s;
    border-radius: 12px;
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
}

.product-card img {
    border-top-left-radius: 12px;
    border-top-right-radius: 12px;
}
</style>