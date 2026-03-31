<?php 
if (session_status() === PHP_SESSION_NONE) {  
    session_start();
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Thêm sản phẩm</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
body { display: flex; flex-direction: column; min-height: 100vh; margin: 0; }
#main { display: flex; flex: 1; }
#sidebar { min-width: 250px; background: #343a40; color: #fff; }
#sidebar h3 { text-align: center; padding: 12px 0; border-bottom: 1px solid #495057; }
#sidebar a { color: #fff; display: block; padding: 12px 20px; text-decoration: none; }
#sidebar a:hover { background: #495057; }
#sidebar a.active { background: #6c757d; }

#content { flex: 1; padding: 20px; background: #f8f9fa; }

.topbar {
    height: 60px; background: #fff;
    display: flex; justify-content: space-between; align-items: center;
    padding: 0 20px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    margin-bottom: 20px;
}

.img-preview { width: 150px; margin-top: 10px; display: none; }

footer { text-align: center; padding: 15px 0; background: #343a40; color: #fff; }
</style>

<script>
function previewImage(event) {
    const preview = document.getElementById('image-preview');
    const file = event.target.files[0];

    if(file && file.size > 2*1024*1024){
        alert('Ảnh tối đa 2MB');
        event.target.value = '';
        return;
    }

    preview.src = URL.createObjectURL(file);
    preview.style.display = 'block';
}

document.addEventListener('DOMContentLoaded', function(){
    const form = document.querySelector('form');

    form.addEventListener('submit', function(e){
        let valid = true;

        const price = form.querySelector('input[name="price"]');
        const quantity = form.querySelector('input[name="quantity"]');

        if(price.value <= 0){
            alert('Giá phải > 0');
            valid = false;
        }

        if(quantity.value < 0){
            alert('Số lượng không hợp lệ');
            valid = false;
        }

        if(!valid) e.preventDefault();
    });
});
</script>

</head>
<body>

<div id="main">

    <!-- Sidebar -->
    <div id="sidebar">
        <h3>Fruit Admin</h3>
        <a href="?act=dashboard"><i class="fa-solid fa-chart-line"></i> Dashboard</a>
        <a href="?act=product" class="active"><i class="fa-solid fa-apple-whole"></i> Sản phẩm</a>
        <a href="?act=category"><i class="fa-solid fa-list"></i> Danh mục</a>
        <a href="?act=customer"><i class="fa-solid fa-users"></i> Khách hàng</a>
        <a href="?act=order"><i class="fa-solid fa-cart-shopping"></i> Đơn hàng</a>
        <a href="?act=logout"><i class="fa-solid fa-right-from-bracket"></i> Đăng xuất</a>
    </div>

    <!-- Content -->
    <div id="content">

        <div class="topbar">
            <strong><i class="fa-solid fa-apple-whole"></i> Fruit Admin</strong>
            <div>
                <?= $_SESSION['user']['full_name'] ?? '' ?>
                <a href="?act=logout" class="btn btn-sm btn-outline-danger ms-2">Đăng xuất</a>
            </div>
        </div>

        <h3><i class="fa-solid fa-plus"></i> Thêm sản phẩm</h3>

        <form action="index.php?act=store_product" method="POST" enctype="multipart/form-data">

            <div class="row">

                <!-- LEFT -->
                <div class="col-6">

                    <div class="mb-3">
                        <label>Tên sản phẩm</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Danh mục</label>
                        <select name="category_id" class="form-select" required>
                            <option value="">-- Chọn danh mục --</option>
                            <?php foreach($categories as $c): ?>
                                <option value="<?= $c->id ?>">
                                    <?= htmlspecialchars($c->name) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Mô tả</label>
                        <textarea name="description" class="form-control"></textarea>
                    </div>

                    <div class="mb-3">
                        <label>Giá (VNĐ)</label>
                        <input type="number" name="price" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Số lượng</label>
                        <input type="number" name="quantity" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Đơn vị</label>
                        <select name="unit" class="form-select">
                            <option value="kg">Kg</option>
                            <option value="trai">Trái</option>
                            <option value="hop">Hộp</option>
                        </select>
                    </div>

                </div>

                <!-- RIGHT -->
                <div class="col-6">

                    <div class="mb-3">
                        <label>Ảnh sản phẩm</label>
                        <input type="file" name="image" class="form-control" accept="image/*" onchange="previewImage(event)" required>
                        <img id="image-preview" class="img-preview">
                    </div>

                    <div class="mb-3">
                        <label>Trạng thái</label>
                        <select name="status" class="form-select">
                            <option value="1">Còn hàng</option>
                            <option value="0">Hết hàng</option>
                        </select>
                    </div>

                </div>

            </div>

            <div class="text-end mt-3">
                <button type="submit" class="btn btn-success">
                    <i class="fa-solid fa-save"></i> Lưu
                </button>
                <a href="?act=product" class="btn btn-secondary">Hủy</a>
            </div>

        </form>

    </div>
</div>

<footer>&copy; 2025 Fruit Store</footer>

</body>
</html>