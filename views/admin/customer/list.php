<h3><i class="fa-solid fa-users"></i> Quản lý khách hàng</h3>

<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Tên</th>
            <th>SĐT</th>
            <th>Email</th>
            <th>Địa chỉ</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($customers as $c): ?>
            <tr>
                <td><?= $c['id'] ?></td>
                <td><?= $c['name'] ?></td>
                <td><?= $c['phone'] ?></td>
                <td><?= $c['email'] ?></td>
                <td><?= $c['address'] ?></td>
                <td>
                    <a href="?act=edit_customer&id=<?= $c['id'] ?>" class="btn btn-warning btn-sm">Sửa</a>
                    <a href="?act=delete_customer&id=<?= $c['id'] ?>" onclick="return confirm('Xóa?')" class="btn btn-danger btn-sm">Xóa</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>