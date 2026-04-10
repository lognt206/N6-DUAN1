<h3>Sửa danh mục</h3>

<form action="?act=update_category" method="POST">

    <input type="hidden" name="id" value="<?= $category['id'] ?>">

    <div class="mb-3">
        <label>Tên danh mục</label>
        <input type="text" name="name"
               value="<?= htmlspecialchars($category['name']) ?>"
               class="form-control" required>
    </div>

    <button class="btn btn-success">Cập nhật</button>
    <a href="?act=category" class="btn btn-secondary">Hủy</a>

</form>