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

    // ===== DASHBOARD =====
    'dashboard' => (new admincontroller())->dashboard(),

    // ===== PRODUCT =====
    'product' => (new admincontroller())->product(),
    'product/create' => (new admincontroller())->create_product(),
    'product/store' => (new admincontroller())->store_product(),
    'product/edit' => (new admincontroller())->edit_product(),
    'product/update' => (new admincontroller())->update_product(),
    'product/delete' => (new admincontroller())->delete_product(),

    default => (new admincontroller())->dashboard(),
};
