<?php
session_start();

// COMMON
require_once './commons/env.php';
require_once './commons/function.php';

// CONTROLLER
require_once './controllers/admincontroller.php';

// MODEL
require_once './models/ProductModel.php';

// ROUTE
$act = $_GET['act'] ?? 'dashboard';

match ($act) {

    'dashboard' => (new admincontroller())->dashboard(),

    // PRODUCT
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

    'customer' => (new admincontroller())->customer(),

    'edit_customer' => (new admincontroller())->edit_customer(),
    'update_customer' => (new admincontroller())->update_customer(),

    'delete_customer' => (new admincontroller())->delete_customer(),

    'order' => (new admincontroller())->order(),
    'detail_order' => (new admincontroller())->detail_order(),
    'update_order_status' => (new admincontroller())->update_order_status(),
    'delete_order' => (new admincontroller())->delete_order(),
    default => (new admincontroller())->dashboard(),
};
