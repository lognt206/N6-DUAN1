<h3 class="mb-3">
    <i class="fa-solid fa-apple-whole"></i> Quản lý sản phẩm
</h3>

<p class="text-muted">Dashboard / Sản phẩm</p>

<a href="?act=create_product" class="btn btn-primary mb-3">
    <i class="fa-solid fa-plus"></i> Thêm sản phẩm
</a>

<div class="card shadow-sm">
    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle text-center">
                
                <thead class="table-dark">
                    <tr>
                        <th width="60">ID</th>
                        <th>Tên</th>
                        <th>Danh mục</th>
                        <th>Giá</th>
                        <th>SL</th>
                        <th>Đơn vị</th>
                        <th>Trạng thái</th>
                        <th>Ảnh</th>
                        <th width="160">Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($products as $p): ?>
                        <tr>

                            <td><?= $p['id'] ?></td>

                            <td class="text-start">
                                <strong><?= htmlspecialchars($p['name']) ?></strong>
                                <br>
                                <small class="text-muted">
                                    <?= htmlspecialchars($p['description'] ?? '') ?>
                                </small>
                            </td>

                            <td><?= $p['category_name'] ?? '---' ?></td>

                            <td class="text-danger fw-bold">
                                <?= number_format($p['price']) ?>đ
                            </td>

                            <td><?= $p['quantity'] ?? 0 ?></td>

                            <td><?= $p['unit'] ?? '' ?></td>

                            <!-- ✅ TRẠNG THÁI CHUẨN -->
                            <td>
                                <?php if (($p['status'] ?? 0) == 1): ?>
                                    <span class="badge bg-success">🟢 Đang bán</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary">🔴 Ngừng bán</span>
                                <?php endif; ?>
                            </td>

                            <td>
                                <?php if (!empty($p['image'])): ?>
                                    <img src="uploads/<?= $p['image'] ?>"
                                         width="70"
                                         style="border-radius:8px;">
                                <?php else: ?>
                                    <span class="text-muted">No img</span>
                                <?php endif; ?>
                            </td>

                            <td>
                                <!-- ✏️ Sửa -->
                                <a href="?act=edit_product&id=<?= $p['id'] ?>"
                                   class="btn btn-warning btn-sm mb-1 w-100">
                                   <i class="fa-solid fa-pen"></i> Sửa
                                </a>

                                <!-- 🔴 / ♻️ NGỪNG BÁN - BÁN LẠI -->
                                <?php if (($p['status'] ?? 0) == 1): ?>
                                    <a href="?act=delete_product&id=<?= $p['id'] ?>"
                                       onclick="return confirm('Ngừng bán sản phẩm này?')"
                                       class="btn btn-danger btn-sm w-100">
                                       🔴 Ngừng bán
                                    </a>
                                <?php else: ?>
                                    <a href="?act=restore_product&id=<?= $p['id'] ?>"
                                       onclick="return confirm('Bán lại sản phẩm này?')"
                                       class="btn btn-success btn-sm w-100">
                                       ♻️ Bán lại
                                    </a>
                                <?php endif; ?>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>
        </div>

    </div>
</div>