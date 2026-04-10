<?php
require_once __DIR__ . '/../models/ProductModel.php';
require_once __DIR__ . '/../models/CategoryModel.php';
require_once __DIR__ . '/../models/CustomerModel.php';
require_once __DIR__ . '/../models/OrderModel.php';

class admincontroller
{
    public $ProductModel;
    public $CategoryModel;
    public $CustomerModel;
    public $OrderModel;


    public function __construct()
    {
        $this->ProductModel = new ProductModel();
        $this->CategoryModel = new CategoryModel();
        $this->CustomerModel = new CustomerModel();
        $this->OrderModel = new OrderModel();
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
        include PATH_ROOT . "views/admin/dashboard.php";
    }

    // ================= PRODUCT =================

    // Danh sách
    public function product()
    {
        $products = $this->ProductModel->all();

        $view = PATH_ROOT . "views/admin/product/noidung.php";
        include PATH_ROOT . "views/admin/dashboard.php";
    }

    // Form thêm
    public function create_product()
    {
        $categories = $this->CategoryModel->all(); // 🔥 lấy từ DB

        $view = PATH_ROOT . "views/admin/product/create.php";
        include PATH_ROOT . "views/admin/dashboard.php";
    }

    // Form sửa
    public function edit_product()
    {
        $products = $this->ProductModel->all();

        $id = $_GET['id'];
        $product = $this->ProductModel->find($id);

        $categories = $this->CategoryModel->all(); // 🔥 lấy từ DB (FIX)

        $view = PATH_ROOT . "views/admin/product/edit.php";
        include PATH_ROOT . "views/admin/dashboard.php";
    }

    // Lưu sản phẩm
    public function store_product()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $image = null;

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

    // Update
    public function update_product()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $id = $_POST['id'];
            $old = $this->ProductModel->find($id);

            $image = $old['image'];

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

    // Xóa
    public function delete_product()
    {
        $id = $_GET['id'];

        $this->ProductModel->delete($id);

        header("Location: ?act=product");
        exit;
    }
    // ===== CATEGORY =====

    public function category()
    {
        $categories = $this->CategoryModel->all();

        $view = PATH_ROOT . "views/admin/category/list.php";
        include PATH_ROOT . "views/admin/dashboard.php";
    }

    public function create_category()
    {
        $view = PATH_ROOT . "views/admin/category/create.php";
        include PATH_ROOT . "views/admin/dashboard.php";
    }

    public function store_category()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $data = [
                'name' => $_POST['name']
            ];

            $this->CategoryModel->create($data);

            header("Location: ?act=category");
            exit;
        }
    }

    public function edit_category()
    {
        $id = $_GET['id'];
        $category = $this->CategoryModel->find($id);

        $view = PATH_ROOT . "views/admin/category/edit.php";
        include PATH_ROOT . "views/admin/dashboard.php";
    }

    public function update_category()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $data = [
                'id' => $_POST['id'],
                'name' => $_POST['name']
            ];

            $this->CategoryModel->update($data);

            header("Location: ?act=category");
            exit;
        }
    }

    public function delete_category()
    {
        $id = $_GET['id'];

        $this->CategoryModel->delete($id);

        header("Location: ?act=category");
        exit;
    }
    // ===== CUSTOMER =====

    // Danh sách
    public function customer()
    {
        $customers = $this->CustomerModel->all();

        $view = PATH_ROOT . "views/admin/customer/list.php";
        include PATH_ROOT . "views/admin/dashboard.php";
    }

    // Form sửa
    public function edit_customer()
    {
        $id = $_GET['id'];
        $customer = $this->CustomerModel->find($id);

        $view = PATH_ROOT . "views/admin/customer/edit.php";
        include PATH_ROOT . "views/admin/dashboard.php";
    }

    // Update
    public function update_customer()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $data = [
                'id'      => $_POST['id'],
                'name'    => $_POST['name'],
                'phone'   => $_POST['phone'],
                'email'   => $_POST['email'],
                'address' => $_POST['address'],
            ];

            $this->CustomerModel->update($data);

            header("Location: ?act=customer");
            exit;
        }
    }

    // Xóa
    public function delete_customer()
    {
        $id = $_GET['id'];

        $this->CustomerModel->delete($id);

        header("Location: ?act=customer");
        exit;
    }
    // ===== ORDER =====

    public function order()
    {
        $orders = $this->OrderModel->all();

        $view = PATH_ROOT . "views/admin/order/list.php";
        include PATH_ROOT . "views/admin/dashboard.php";
    }

    public function detail_order()
    {
        $id = $_GET['id'];

        $order = $this->OrderModel->find($id);
        $items = $this->OrderModel->getItems($id);

        $view = PATH_ROOT . "views/admin/order/detail.php";
        include PATH_ROOT . "views/admin/dashboard.php";
    }

    public function update_order_status()
    {
        $id = $_GET['id'];
        $status = $_GET['status'];

        $this->OrderModel->updateStatus($id, $status);

        header("Location: ?act=order");
        exit;
    }

    public function delete_order()
    {
        $id = $_GET['id'];

        $this->OrderModel->delete($id);

        header("Location: ?act=order");
        exit;
    }
}
