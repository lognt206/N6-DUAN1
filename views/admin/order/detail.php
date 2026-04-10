<h3>Chi tiết đơn hàng #<?= $order['id'] ?></h3>

<p><b>Khách:</b> <?= $order['customer_name'] ?></p>
<p><b>SĐT:</b> <?= $order['phone'] ?></p>
<p><b>Địa chỉ:</b> <?= $order['address'] ?></p>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Sản phẩm</th>
            <th>SL</th>
            <th>Giá</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($items as $i): ?>
            <tr>
                <td><?= $i['name'] ?></td>
                <td><?= $i['quantity'] ?></td>
                <td><?= number_format($i['price']) ?>đ</td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>