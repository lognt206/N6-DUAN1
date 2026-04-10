<h3><i class="fa-solid fa-cart-shopping"></i> Quản lý đơn hàng</h3>

<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Khách</th>
            <th>SĐT</th>
            <th>Tổng tiền</th>
            <th>Trạng thái</th>
            <th>Ngày</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($orders as $o): ?>
            <tr>
                <td><?= $o['id'] ?></td>
                <td><?= $o['customer_name'] ?></td>
                <td><?= $o['phone'] ?></td>
                <td><?= number_format($o['total']) ?>đ</td>

                <td>
                    <?php if ($o['status'] == 0): ?>
                        <span class="badge bg-warning">Đang xử lý</span>
                    <?php else: ?>
                        <span class="badge bg-success">Hoàn thành</span>
                    <?php endif; ?>
                </td>

                <td><?= $o['created_at'] ?></td>

                <td>
                    <a href="?act=detail_order&id=<?= $o['id'] ?>" class="btn btn-info btn-sm">Xem</a>

                    <a href="?act=update_order_status&id=<?= $o['id'] ?>&status=1"
                       class="btn btn-success btn-sm">✔</a>

                    <a href="?act=delete_order&id=<?= $o['id'] ?>"
                       onclick="return confirm('Xóa đơn?')"
                       class="btn btn-danger btn-sm">X</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>