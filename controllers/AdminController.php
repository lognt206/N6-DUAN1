<?php
require_once __DIR__ . '/../models/ProductModel.php';
require_once __DIR__ . '/../models/CategoryModel.php';
require_once __DIR__ . '/../models/OrderModel.php';
require_once __DIR__ . '/../models/UserModel.php';

class admincontroller
{
    public $ProductModel;
    public $CategoryModel;
    public $OrderModel;
    public $UserModel;

    public function __construct()
    {
        $this->ProductModel = new ProductModel();
        $this->CategoryModel = new CategoryModel();
        $this->OrderModel = new OrderModel();
        $this->UserModel = new UserModel();
    }

    // ===== DASHBOARD =====
    public function dashboard()
    {
        $totalProducts = count($this->ProductModel->all());
        $totalCustomers = count($this->UserModel->getUsers());
        $totalOrders = count($this->OrderModel->all());
        $totalRevenue = $this->OrderModel->getRevenue();

        // Chart
        $chartData = $this->OrderModel->getRevenueByMonth();
        $chartLabels = array_column($chartData, 'month');
        $chartValues = array_column($chartData, 'revenue');

        // Đơn mới
        $latestOrders = $this->OrderModel->getLatestOrders();

        // Top sản phẩm
        $topProducts = $this->OrderModel->getTopProducts();

        $view = PATH_ROOT . "views/admin/dashboard_content.php";
        include PATH_ROOT . "views/admin/dashboard.php";
    }

    // ================= PRODUCT =================
    public function product()
    {
        $products = $this->ProductModel->all();

        $view = PATH_ROOT . "views/admin/product/noidung.php";
        include PATH_ROOT . "views/admin/dashboard.php";
    }

    public function create_product()
    {
        $categories = $this->CategoryModel->all();

        $view = PATH_ROOT . "views/admin/product/create.php";
        include PATH_ROOT . "views/admin/dashboard.php";
    }

    public function edit_product()
    {
        $id = $_GET['id'];
        $product = $this->ProductModel->find($id);
        $categories = $this->CategoryModel->all();

        $view = PATH_ROOT . "views/admin/product/edit.php";
        include PATH_ROOT . "views/admin/dashboard.php";
    }

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
                'status'      => $_POST['status'] ?? 1, // ✅ FIX
                'image'       => $image
            ];

            $this->ProductModel->create($data);

            header("Location: ?act=product");
            exit;
        }
    }

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
                'status'      => $_POST['status'] ?? 1, // ✅ FIX
                'image'       => $image
            ];

            $this->ProductModel->update($data);

            header("Location: ?act=product");
            exit;
        }
    }

    // 🔴 NGỪNG BÁN (soft delete)
    public function delete_product()
    {
        $id = $_GET['id'];
        $this->ProductModel->delete($id);

        header("Location: ?act=product");
        exit;
    }

    // ♻️ BÁN LẠI
    public function restore_product()
    {
        $id = $_GET['id'];
        $this->ProductModel->restore($id);

        header("Location: ?act=product");
        exit;
    }

    // ================= CATEGORY =================
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

    // ================= CUSTOMER =================
    public function customer()
    {
        $customers = $this->UserModel->all();

        $view = PATH_ROOT . "views/admin/customer/list.php";
        include PATH_ROOT . "views/admin/dashboard.php";
    }

    // ================= ORDER =================
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

        $valid = ['pending', 'processing', 'shipping', 'completed', 'cancel'];

        if (!in_array($status, $valid)) {
            die("Status không hợp lệ");
        }

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