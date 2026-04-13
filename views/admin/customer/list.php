<h3><i class="fa-solid fa-users"></i> Quản lý tài khoản</h3>

<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Tên</th>
            <th>Email</th>
            <th>Vai trò</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($customers as $c): ?>
            <tr>
                <td><?= $c['id'] ?></td>
                <td><?= $c['full_name'] ?? '---' ?></td>
                <td><?= $c['email'] ?></td>
                <td>
                    <span class="badge bg-<?= $c['role'] == 'admin' ? 'danger' : 'secondary' ?>">
                        <?= $c['role'] ?>
                    </span>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>