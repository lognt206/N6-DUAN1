<?php
require_once __DIR__ . '/../models/ProductModel.php';

class admincontroller
{
    public $ProductModel;

    public function __construct()
    {
        $this->ProductModel = new ProductModel();
    }

    // ===== DASHBOARD =====
    public function dashboard()
{
    $totalProducts = count($this->ProductModel->all());

    $totalCustomers = 0;
    $totalOrders = 0;
    $totalRevenue = 0;

    $chartLabels = [];
    $chartValues = [];

    $view = PATH_ROOT . "views/admin/dashboard_content.php";

    include PATH_ROOT . "views/admin/dashboard.php"; // layout
}
    // ================= PRODUCT =================

    // Danh sách
    public function product()
{
    $products = $this->ProductModel->all();

    $view = PATH_ROOT . "views/admin/product/noidung.php";

    include PATH_ROOT . "views/admin/dashboard.php"; // layout
}

    // Form thêm
    public function create_product()
    {
        include PATH_ROOT . "views/admin/product/create.php";
    }

    // Lưu sản phẩm
    public function store_product()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $image = null;

            // Upload ảnh
            if (!empty($_FILES['image']['name'])) {
                $dir = "uploads/";
                if (!is_dir($dir)) mkdir($dir);

                $image = time() . "_" . $_FILES['image']['name'];
                move_uploaded_file($_FILES['image']['tmp_name'], $dir . $image);
            }

            $data = [
                'name'        => $_POST['name'],
                'price'       => $_POST['price'],
                'quantity'    => $_POST['quantity'],
                'unit'        => $_POST['unit'],
                'category_id' => $_POST['category_id'],
                'description' => $_POST['description'],
                'status'      => $_POST['status'],
                'image'       => $image
            ];

            $this->ProductModel->create($data);

            header("Location: ?act=product");
            exit;
        }
    }

    // Form sửa
    public function edit_product()
    {
        $id = $_GET['id'];
        $product = $this->ProductModel->find($id);

        include PATH_ROOT . "views/admin/product/update.php";
    }

    // Update sản phẩm
    public function update_product()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $id = $_POST['id'];
            $old = $this->ProductModel->find($id);

            $image = $old['image'];

            // Upload ảnh mới nếu có
            if (!empty($_FILES['image']['name'])) {
                $dir = "uploads/";
                $image = time() . "_" . $_FILES['image']['name'];
                move_uploaded_file($_FILES['image']['tmp_name'], $dir . $image);
            }

            $data = [
                'id'          => $id,
                'name'        => $_POST['name'],
                'price'       => $_POST['price'],
                'quantity'    => $_POST['quantity'],
                'unit'        => $_POST['unit'],
                'category_id' => $_POST['category_id'],
                'description' => $_POST['description'],
                'status'      => $_POST['status'],
                'image'       => $image
            ];

            $this->ProductModel->update($data);

            header("Location: ?act=product");
            exit;
        }
    }

    // Xóa sản phẩm
    public function delete_product()
    {
        $id = $_GET['id'];

        $this->ProductModel->delete($id);

        header("Location: ?act=product");
        exit;
    }
}