<h3 class="mb-3"><i class="fa-solid fa-cart-shopping"></i> Quản lý đơn hàng</h3>

<div class="card shadow">
    <div class="card-body">

        <table class="table table-hover align-middle text-center">

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
                        <td>#<?= $o['id'] ?></td>

                        <!-- 👤 TÊN KHÁCH -->
                        <td class="text-start">
                            <b><?= $o['customer_name'] ?: ($o['full_name'] ?? 'Khách lẻ') ?></b>
                        </td>

                        <td><?= $o['phone'] ?></td>

                        <td class="text-danger fw-bold">
                            <?= number_format($o['total_price']) ?>đ
                        </td>

                        <!-- 🔥 TRẠNG THÁI -->
                        <td>
                            <?php
                            switch ($o['status']) {
                                case 'pending':
                                    $label = 'Chờ xử lý';
                                    $class = 'secondary';
                                    $next = 'processing';
                                    break;

                                case 'processing':
                                    $label = 'Đang xử lý';
                                    $class = 'info';
                                    $next = 'shipping';
                                    break;

                                case 'shipping':
                                    $label = 'Đang giao';
                                    $class = 'primary';
                                    $next = 'completed';
                                    break;

                                case 'completed':
                                    $label = 'Hoàn thành';
                                    $class = 'success';
                                    $next = 'completed';
                                    break;

                                default:
                                    $label = 'Không rõ';
                                    $class = 'dark';
                                    $next = 'pending';
                            }
                            ?>

                            <a href="?act=update_order_status&id=<?= $o['id'] ?>&status=<?= $next ?>"
                                style="text-decoration:none">
                                <span class="badge bg-<?= $class ?>">
                                    <?= $label ?>
                                </span>
                            </a>
                        </td>

                        <td><?= $o['created_at'] ?></td>

                        <!-- ACTION -->
                        <td>
                            <a href="?act=detail_order&id=<?= $o['id'] ?>"
                                class="btn btn-info btn-sm">
                                <i class="fa fa-eye"></i>
                            </a>

                            <a href="?act=update_order_status&id=<?= $o['id'] ?>&status=cancelled"
                                onclick="return confirm('Huỷ đơn?')"
                                class="btn btn-warning btn-sm">Huỷ</a>

                            <a href="?act=delete_order&id=<?= $o['id'] ?>"
                                onclick="return confirm('Xóa đơn?')"
                                class="btn btn-danger btn-sm">X</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>

        </table>

    </div>
</div>