<h3>
    <i class="fa-solid fa-apple-whole"></i> Quản lý sản phẩm
</h3>
<p class="text-muted">Dashboard / Sản phẩm</p>
<a href="?act=create_product" class="btn btn-primary mb-3">
    + Thêm sản phẩm
</a>

<div class="card">
    <div class="card-body">

        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Tên</th>
                            <th>Giá</th>
                            <th>Ảnh</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($products as $p): ?>
                            <tr>
                                <td><?= $p['id'] ?></td>
                                <td><?= $p['name'] ?></td>
                                <td><?= number_format($p['price']) ?>đ</td>
                                <td>
                                    <img src="uploads/<?= $p['image'] ?>" width="60">
                                </td>
                                <td>
                                    <a href="?act=edit_product&id=<?= $p['id'] ?>"
                                        class="btn btn-warning btn-sm">
                                        Sửa
                                    </a>

                                    <a href="?act=delete_product&id=<?= $p['id'] ?>"
                                        onclick="return confirm('Xóa?')"
                                        class="btn btn-danger btn-sm">
                                        Xóa
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>