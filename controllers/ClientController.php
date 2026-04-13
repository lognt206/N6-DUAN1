<?php
require_once __DIR__ . '/../models/ProductModel.php';
require_once __DIR__ . '/../models/OrderModel.php';

class ClientController
{
    public $ProductModel;
    public $OrderModel;

    public function __construct()
    {
        $this->ProductModel = new ProductModel();
        $this->OrderModel = new OrderModel();

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
    }

    // 🏠 Trang chủ
    public function home()
    {
        $products = $this->ProductModel->all();
        $view = "views/client/home.php";
        include "views/layouts/client.php";
    }

    // ➕ Thêm vào giỏ
    public function add_cart()
    {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            header("Location: ?act=home");
            exit;
        }

        $product = $this->ProductModel->find($id);

        if (!$product) {
            header("Location: ?act=home");
            exit;
        }

        if (!isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id] = [
                'name' => $product['name'],
                'price' => $product['price'],
                'quantity' => 1
            ];
        } else {
            $_SESSION['cart'][$id]['quantity']++;
        }

        header("Location: ?act=home&msg=added");
        exit;
    }

    // 🛒 Giỏ hàng
    public function cart()
    {
        $view = "views/client/cart.php";
        include "views/layouts/client.php";
    }

    // 🔄 Update số lượng
    public function cart_update()
    {
        $id = $_POST['id'] ?? null;
        $qty = max(1, (int)($_POST['quantity'] ?? 1));

        if ($id && isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]['quantity'] = $qty;
        }

        header("Location: ?act=cart");
        exit;
    }

    // ❌ Xoá sản phẩm
    public function cart_remove()
    {
        $id = $_GET['id'] ?? null;

        if ($id && isset($_SESSION['cart'][$id])) {
            unset($_SESSION['cart'][$id]);
        }

        header("Location: ?act=cart");
        exit;
    }

    // 💳 Thanh toán
    public function checkout()
    {
        if (empty($_SESSION['cart'])) {
            header("Location: ?act=cart");
            exit;
        }

        $view = "views/client/checkout.php";
        include "views/layouts/client.php";
    }

    // 📦 Đặt hàng
    public function place_order()
    {
        if (empty($_SESSION['cart'])) {
            header("Location: ?act=cart");
            exit;
        }

        $user = $_SESSION['user'] ?? null;

        $data = [
            'user_id' => $user['id'] ?? null,
            'customer_name' => $user ? $user['name'] : $_POST['name'],
            'phone' => $_POST['phone'],
            'address' => $_POST['address'],
            'cart' => $_SESSION['cart']
        ];

        $this->OrderModel->createOrder($data);

        unset($_SESSION['cart']);

        header("Location: ?act=orders");
        exit;
    }

    // 📜 Danh sách đơn hàng
    public function orders()
    {
        $user_id = $_SESSION['user']['id'] ?? null;

        if (!$user_id) {
            header("Location: ?act=login");
            exit;
        }

        $orders = $this->OrderModel->getByUser($user_id);

        $view = "views/client/orders.php";
        include "views/layouts/client.php";
    }

    // 🔍 CHI TIẾT ĐƠN HÀNG
    public function order_detail()
    {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            header("Location: ?act=orders");
            exit;
        }

        $order = $this->OrderModel->find($id);
        $items = $this->OrderModel->getItems($id);

        // 🔥 chống xem trộm đơn
        if (!$order || $order['user_id'] != $_SESSION['user']['id']) {
            die("❌ Không có quyền truy cập!");
        }

        $view = "views/client/order_detail.php";
        include "views/layouts/client.php";
    }

    // ✔ Xác nhận đã nhận hàng
    public function complete_order()
    {
        $id = $_GET['id'] ?? null;

        if ($id) {
            // 🔥 dùng STRING (đúng chuẩn)
            $this->OrderModel->updateStatus($id, 'completed');
        }

        header("Location: ?act=orders");
        exit;
    }
    
}