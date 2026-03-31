<h3 class="mb-3"><i class="fa-solid fa-apple-whole"></i> Sửa sản phẩm</h3>

<form action="index.php?act=update_product&id=<?= $product->id ?>" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $product->id ?>">

    <div class="row">
        <!-- LEFT -->
        <div class="col-6">
            <h5 class="mb-3">Thông tin sản phẩm</h5>

            <div class="mb-3">
                <label class="form-label">Tên sản phẩm</label>
                <input type="text" class="form-control" name="name"
                       value="<?= htmlspecialchars($product->name) ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Loại trái cây</label>
                <select class="form-select" name="category_id">
                    <?php foreach ($categories as $c): ?>
                        <option value="<?= $c->id ?>"
                            <?= $product->category_id == $c->id ? 'selected' : '' ?>>
                            <?= htmlspecialchars($c->name) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Mô tả</label>
                <textarea class="form-control" name="description"><?= htmlspecialchars($product->description) ?></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Giá (VNĐ)</label>
                <input type="number" class="form-control" name="price"
                       value="<?= $product->price ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Số lượng</label>
                <input type="number" class="form-control" name="quantity"
                       value="<?= $product->quantity ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Đơn vị</label>
                <select class="form-select" name="unit">
                    <option value="kg" <?= $product->unit == 'kg' ? 'selected' : '' ?>>Kg</option>
                    <option value="trai" <?= $product->unit == 'trai' ? 'selected' : '' ?>>Trái</option>
                    <option value="hop" <?= $product->unit == 'hop' ? 'selected' : '' ?>>Hộp</option>
                </select>
            </div>
        </div>

        <!-- RIGHT -->
        <div class="col-6">
            <h5 class="mb-3">Hình ảnh & trạng thái</h5>

            <div class="mb-3">
                <label class="form-label">Ảnh sản phẩm</label>
                <input type="file" class="form-control" name="image" onchange="previewImage(event)">
                <input type="hidden" name="old_image" value="<?= $product->image ?>">

                <?php if(!empty($product->image)): ?>
                    <img src="<?= $product->image ?>" id="image-preview" class="img-preview">
                <?php else: ?>
                    <img id="image-preview" class="img-preview" style="display:none;">
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label class="form-label">Trạng thái</label>
                <select class="form-select" name="status">
                    <option value="1" <?= $product->status == 1 ? 'selected' : '' ?>>Còn hàng</option>
                    <option value="0" <?= $product->status == 0 ? 'selected' : '' ?>>Hết hàng</option>
                </select>
            </div>
        </div>
    </div>

    <div class="text-end mt-4">
        <button type="submit" class="btn btn-success">
            <i class="fa-solid fa-save"></i> Lưu sản phẩm
        </button>
        <a href="?act=product" class="btn btn-secondary">Hủy</a>
    </div>
</form>