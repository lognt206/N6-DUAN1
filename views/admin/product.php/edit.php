<?php include "views/admin/layout/header.php"; ?>
<?php include "views/admin/layout/sidebar.php"; ?>

<h2>Sửa sản phẩm</h2>

<form method="POST" action="?act=product/update" enctype="multipart/form-data">

    <input type="hidden" name="id" value="<?= $product['id'] ?>">

    <label>Tên sản phẩm</label><br>
    <input type="text" name="name" value="<?= $product['name'] ?>"><br><br>

    <label>Giá</label><br>
    <input type="number" name="price" value="<?= $product['price'] ?>"><br><br>

    <label>Ảnh hiện tại</label><br>
    <img src="uploads/<?= $product['image'] ?>" width="100"><br><br>

    <label>Ảnh mới</label><br>
    <input type="file" name="image"><br><br>

    <button class="btn btn-edit">Cập nhật</button>

</form>

<?php include "views/admin/layout/footer.php"; ?>
