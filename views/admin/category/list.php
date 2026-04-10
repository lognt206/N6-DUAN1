<h3>
    <i class="fa-solid fa-list"></i> Quản lý danh mục
</h3>

<p class="text-muted">Dashboard / Danh mục</p>

<a href="?act=create_category" class="btn btn-primary mb-3">
    + Thêm danh mục
</a>

<div class="card">
    <div class="card-body">

        <table class="table table-bordered table-hover w-100">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Tên danh mục</th>
                    <th>Số sản phẩm</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                <?php if (!empty($categories)): ?>
                    <?php foreach ($categories as $c): ?>
                        <tr>
                            <td><?= $c['id'] ?></td>

                            <td><?= htmlspecialchars($c['name']) ?></td>

                            <!-- Nếu chưa có count thì để 0 -->
                            <td><?= $c['total_products'] ?? 0 ?></td>

                            <td>
                                <a href="?act=edit_category&id=<?= $c['id'] ?>"
                                   class="btn btn-warning btn-sm">
                                    Sửa
                                </a>

                                <a href="?act=delete_category&id=<?= $c['id'] ?>"
                                   onclick="return confirm('Xóa danh mục?')"
                                   class="btn btn-danger btn-sm">
                                    Xóa
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center text-muted">
                            Chưa có danh mục
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>

        </table>

    </div>
</div>