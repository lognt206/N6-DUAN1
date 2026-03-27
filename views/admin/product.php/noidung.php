<?php include "views/admin/layout/header.php"; ?>
<?php include "views/admin/layout/sidebar.php"; ?>

<h2>Danh sách sản phẩm</h2>

<a class="btn btn-add" href="?act=product/create">+ Thêm sản phẩm</a>

<br><br>

<table>
<tr>
    <th>ID</th>
    <th>Tên</th>
    <th>Giá</th>
    <th>Ảnh</th>
    <th>Action</th>
</tr>

<?php foreach($products as $p): ?>
<tr>
    <td><?= $p['id'] ?></td>
    <td><?= $p['name'] ?></td>
    <td><?= number_format($p['price']) ?>đ</td>
    <td>
        <img src="uploads/<?= $p['image'] ?>" width="80">
    </td>
    <td>
        <a class="btn btn-edit" href="?act=product/edit&id=<?= $p['id'] ?>">Sửa</a>
        <a class="btn btn-delete" 
           onclick="return confirm('Xóa?')" 
           href="?act=product/delete&id=<?= $p['id'] ?>">Xóa</a>
    </td>
</tr>
<?php endforeach; ?>

</table>

<?php include "views/admin/layout/footer.php"; ?>
