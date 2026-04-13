<h3>📄 Chi tiết đơn #<?= $order['id'] ?></h3>

<p><b>Ngày:</b> <?= $order['created_at'] ?></p>
<p><b>Người nhận:</b> <?= $order['customer_name'] ?></p>
<p><b>SĐT:</b> <?= $order['phone'] ?></p>
<p><b>Địa chỉ:</b> <?= $order['address'] ?></p>

<hr>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Sản phẩm</th>
            <th>Giá</th>
            <th>SL</th>
            <th>Thành tiền</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($items as $i): ?>
        <tr>
            <td><?= $i['name'] ?></td>
            <td><?= number_format($i['price']) ?>đ</td>
            <td><?= $i['quantity'] ?></td>
            <td><?= number_format($i['price'] * $i['quantity']) ?>đ</td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<h4 class="text-end text-danger">
    Tổng: <?= number_format($order['total_price']) ?>đ
</h4>

<a href="?act=orders" class="btn btn-secondary">← Quay lại</a>