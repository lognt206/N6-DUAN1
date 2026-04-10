<h3 class="mb-3">
    <i class="fa-solid fa-apple-whole"></i> Sửa sản phẩm
</h3>

<p class="text-muted">Dashboard / Sản phẩm / Sửa</p>

<form action="?act=update_product" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $product['id'] ?>">

    <div class="card shadow-sm">
        <div class="card-body">

            <div class="row">

                <!-- LEFT -->
                <div class="col-md-6">
                    <h5 class="mb-3">Thông tin sản phẩm</h5>

                    <!-- Tên -->
                    <div class="mb-3">
                        <label class="form-label">Tên sản phẩm</label>
                        <input type="text" class="form-control" name="name"
                               value="<?= htmlspecialchars($product['name'] ?? '') ?>" required>
                    </div>

                    <!-- Category -->
                    <div class="mb-3">
                        <label class="form-label">Loại trái cây</label>
                        <select class="form-select" name="category_id" required>
                            <?php foreach ($categories as $c): ?>
                                <option value="<?= $c['id'] ?>"
                                    <?= ($product['category_id'] ?? 0) == $c['id'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($c['name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Mô tả -->
                    <div class="mb-3">
                        <label class="form-label">Mô tả</label>
                        <textarea class="form-control" name="description" rows="4"><?= htmlspecialchars($product['description'] ?? '') ?></textarea>
                    </div>

                    <!-- Giá -->
                    <div class="mb-3">
                        <label class="form-label">Giá (VNĐ)</label>
                        <input type="number" class="form-control" name="price"
                               value="<?= $product['price'] ?? 0 ?>" required>
                    </div>

                    <!-- Số lượng -->
                    <div class="mb-3">
                        <label class="form-label">Số lượng</label>
                        <input type="number" class="form-control" name="quantity"
                               value="<?= $product['quantity'] ?? 0 ?>" required>
                    </div>

                    <!-- Đơn vị -->
                    <div class="mb-3">
                        <label class="form-label">Đơn vị</label>
                        <select class="form-select" name="unit">
                            <option value="kg" <?= ($product['unit'] ?? '') == 'kg' ? 'selected' : '' ?>>Kg</option>
                            <option value="trai" <?= ($product['unit'] ?? '') == 'trai' ? 'selected' : '' ?>>Trái</option>
                            <option value="hop" <?= ($product['unit'] ?? '') == 'hop' ? 'selected' : '' ?>>Hộp</option>
                        </select>
                    </div>
                </div>

                <!-- RIGHT -->
                <div class="col-md-6">
                    <h5 class="mb-3">Hình ảnh & trạng thái</h5>

                    <!-- Ảnh -->
                    <div class="mb-3">
                        <label class="form-label">Ảnh sản phẩm</label>
                        <input type="file" class="form-control" name="image">

                        <input type="hidden" name="old_image" value="<?= $product['image'] ?>">

                        <?php if (!empty($product['image'])): ?>
                            <img src="uploads/<?= $product['image'] ?>"
                                 width="150"
                                 style="margin-top:10px; border-radius:8px;">
                        <?php else: ?>
                            <p class="text-muted mt-2">Chưa có ảnh</p>
                        <?php endif; ?>
                    </div>

                    <!-- Trạng thái -->
                    <div class="mb-3">
                        <label class="form-label">Trạng thái</label>
                        <select class="form-select" name="status">
                            <option value="1" <?= ($product['status'] ?? 0) == 1 ? 'selected' : '' ?>>Còn hàng</option>
                            <option value="0" <?= ($product['status'] ?? 0) == 0 ? 'selected' : '' ?>>Hết hàng</option>
                        </select>
                    </div>
                </div>

            </div>

            <!-- BUTTON -->
            <div class="text-end mt-4">
                <button type="submit" class="btn btn-success">
                    <i class="fa-solid fa-save"></i> Lưu sản phẩm
                </button>

                <a href="?act=product" class="btn btn-secondary">Hủy</a>
            </div>

        </div>
    </div>
</form>