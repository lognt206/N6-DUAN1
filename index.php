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

    default => (new admincontroller())->dashboard(),
};
