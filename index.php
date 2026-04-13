<?php
session_start();

// ================= COMMON =================
require_once './commons/env.php';
require_once './commons/function.php';

// ================= CONTROLLER =================
require_once './controllers/admincontroller.php';
require_once './controllers/AuthController.php';
require_once './controllers/ClientController.php';

// ================= MODEL =================
require_once './models/ProductModel.php';
require_once './models/CategoryModel.php';
require_once './models/OrderModel.php';
require_once './models/UserModel.php';

// ================= ROUTE =================

// 👉 Mặc định vào LOGIN
$act = $_GET['act'] ?? 'login';

// 👉 Route KHÔNG cần login
$publicRoutes = [
    'login',
    'handle_login',
    'register',
    'handle_register'
];

// 👉 Nếu chưa login → chặn
if (!isset($_SESSION['user']) && !in_array($act, $publicRoutes)) {
    header("Location: ?act=login");
    exit;
}

// 👉 Route ADMIN
$adminRoutes = [
    'dashboard',

    'product', 'create_product', 'store_product',
    'edit_product', 'update_product', 'delete_product',

    'category', 'create_category', 'store_category',
    'edit_category', 'update_category', 'delete_category',

    // 🔥 chỉ giữ customer LIST (không còn edit/delete)
    'customer',

    'order', 'detail_order', 'update_order_status', 'delete_order'
];

// 👉 Check quyền admin
if (in_array($act, $adminRoutes)) {
    if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
        die("❌ Không có quyền truy cập!");
    }
}

// ================= MATCH =================
match ($act) {

    // ===== AUTH =====
    'login' => (new AuthController())->login(),
    'handle_login' => (new AuthController())->handle_login(),

    'register' => (new AuthController())->register(),
    'handle_register' => (new AuthController())->handle_register(),

    'logout' => (new AuthController())->logout(),

    // ===== CLIENT =====
    'home' => (new ClientController())->home(),
    'add_cart' => (new ClientController())->add_cart(),
    'cart' => (new ClientController())->cart(),

    'cart_update' => (new ClientController())->cart_update(),
    'cart_remove' => (new ClientController())->cart_remove(),

    'checkout' => (new ClientController())->checkout(),
    'place_order' => (new ClientController())->place_order(),

    'orders' => (new ClientController())->orders(),
    'order_detail' => (new ClientController())->order_detail(),
    'complete_order' => (new ClientController())->complete_order(),

    // ===== ADMIN =====
    'dashboard' => (new admincontroller())->dashboard(),

    'product' => (new admincontroller())->product(),
    'create_product' => (new admincontroller())->create_product(),
    'store_product' => (new admincontroller())->store_product(),
    'edit_product' => (new admincontroller())->edit_product(),
    'update_product' => (new admincontroller())->update_product(),
    'delete_product' => (new admincontroller())->delete_product(),

    'category' => (new admincontroller())->category(),
    'create_category' => (new admincontroller())->create_category(),
    'store_category' => (new admincontroller())->store_category(),
    'edit_category' => (new admincontroller())->edit_category(),
    'update_category' => (new admincontroller())->update_category(),
    'delete_category' => (new admincontroller())->delete_category(),

    // 🔥 chỉ còn xem danh sách user
    'customer' => (new admincontroller())->customer(),

    'order' => (new admincontroller())->order(),
    'detail_order' => (new admincontroller())->detail_order(),
    'update_order_status' => (new admincontroller())->update_order_status(),
    'delete_order' => (new admincontroller())->delete_order(),

    // ===== DEFAULT =====
    default => header("Location: ?act=login"),
};