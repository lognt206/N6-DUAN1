<?php
require_once __DIR__ . '/../models/UserModel.php';

class AuthController
{
    public $UserModel;

    public function __construct()
    {
        $this->UserModel = new UserModel();
    }

    // ===== LOGIN =====
    public function login()
    {
        include "views/auth/login.php";
    }

    public function handle_login()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = $this->UserModel->findByEmail($email);

        // 🔥 dùng password_verify
        if ($user && password_verify($password, $user['password'])) {

            $_SESSION['user'] = $user;

            if ($user['role'] == 'admin') {
                header("Location: ?act=dashboard");
            } else {
                header("Location: ?act=home");
            }
        } else {
            echo "Sai tài khoản hoặc mật khẩu";
        }
    }

    // ===== REGISTER =====
    public function register()
    {
        include "views/auth/register.php";
    }

    public function handle_register()
    {
        $data = [
            'full_name' => $_POST['full_name'], // ✅ FIX
            'email' => $_POST['email'],
            'password' => $_POST['password']
        ];

        $this->UserModel->create($data);

        header("Location: ?act=login");
    }
    // ===== LOGOUT =====
    public function logout()
    {
        session_destroy();
        header("Location: ?act=login");
    }
}
