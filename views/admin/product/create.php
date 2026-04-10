<h3>
    <i class="fa-solid fa-plus"></i> Thêm sản phẩm
</h3>

<form action="?act=store_product" method="POST" enctype="multipart/form-data">

    <div class="row">

        <!-- LEFT -->
        <div class="col-6">

            <div class="mb-3">
                <label>Tên sản phẩm</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Danh mục</label>
                <select name="category_id" class="form-select">
                    <option value="">-- Chọn danh mục --</option>
                    <?php if (!empty($categories)): ?>
                        <?php foreach($categories as $c): ?>
                            <option value="<?= $c['id'] ?>">
                                <?= htmlspecialchars($c['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>

            <div class="mb-3">
                <label>Mô tả</label>
                <textarea name="description" class="form-control"></textarea>
            </div>

            <div class="mb-3">
                <label>Giá (VNĐ)</label>
                <input type="number" name="price" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Số lượng</label>
                <input type="number" name="quantity" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Đơn vị</label>
                <select name="unit" class="form-select">
                    <option value="kg">Kg</option>
                    <option value="trai">Trái</option>
                    <option value="hop">Hộp</option>
                </select>
            </div>

        </div>

        <!-- RIGHT -->
        <div class="col-6">

            <div class="mb-3">
                <label>Ảnh sản phẩm</label>
                <input type="file" name="image" class="form-control" accept="image/*" onchange="previewImage(event)">
                <img id="image-preview" style="width:120px; margin-top:10px; display:none;">
            </div>

            <div class="mb-3">
                <label>Trạng thái</label>
                <select name="status" class="form-select">
                    <option value="1">Còn hàng</option>
                    <option value="0">Hết hàng</option>
                </select>
            </div>

        </div>

    </div>

    <div class="text-end mt-3">
        <button type="submit" class="btn btn-success">
            <i class="fa-solid fa-save"></i> Lưu
        </button>

        <a href="?act=product" class="btn btn-secondary">Hủy</a>
    </div>

</form>

<script>
function previewImage(event) {
    const preview = document.getElementById('image-preview');
    const file = event.target.files[0];

    if (file) {
        preview.src = URL.createObjectURL(file);
        preview.style.display = 'block';
    }
}
</script>