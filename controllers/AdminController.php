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
        include PATH_ROOT . "views/admin/dashboard.php";

    }

    // ================= PRODUCT =================

    // Danh sách
    public function product()
    {
        $products = $this->ProductModel->all();
        include PATH_ROOT . "views/admin/product/index.php";
    }

    // Form thêm
    public function create_product()
    {
        include PATH_ROOT . "views/admin/product/add.php";
    }

    // Lưu
    public function store_product()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $image = null;

            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $dir = "uploads/";
                if (!is_dir($dir)) mkdir($dir);

                $image = time() . "_" . $_FILES['image']['name'];
                move_uploaded_file($_FILES['image']['tmp_name'], $dir . $image);
            }

            $data = [
                'name'  => $_POST['name'],
                'price' => $_POST['price'],
                'image' => $image
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

        include PATH_ROOT . "views/admin/product/edit.php";
    }

    // Update
    public function update_product()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $id = $_POST['id'];
            $old = $this->ProductModel->find($id);

            $image = $old['image'];

            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $dir = "uploads/";
                $image = time() . "_" . $_FILES['image']['name'];
                move_uploaded_file($_FILES['image']['tmp_name'], $dir . $image);
            }

            $data = [
                'id'    => $id,
                'name'  => $_POST['name'],
                'price' => $_POST['price'],
                'image' => $image
            ];

            $this->ProductModel->update($data);

            header("Location: ?act=product");
            exit;
        }
    }

    // Xóa

    public function delete_product()
    {
        $id = $_GET['id'];

        $this->ProductModel->delete($id);

        header("Location: ?act=product");
        exit;
    }
}
