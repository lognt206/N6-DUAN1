<?php include "views/admin/layout/header.php"; ?>
<?php include "views/admin/layout/sidebar.php"; ?>

<h2>Thêm sản phẩm</h2>

<form method="POST" action="?act=product/store" enctype="multipart/form-data">

    <label>Tên sản phẩm</label><br>
    <input type="text" name="name"><br><br>

    <label>Giá</label><br>
    <input type="number" name="price"><br><br>

    <label>Ảnh</label><br>
    <input type="file" name="image"><br><br>

    <button class="btn btn-add">Thêm</button>

</form>

<?php include "views/admin/layout/footer.php"; ?>
