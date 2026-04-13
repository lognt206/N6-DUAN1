<?php
require_once __DIR__ . '/../commons/function.php';

class UserModel
{
    private $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    // ===== LOGIN =====
    public function findByEmail($email)
    {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email=?");
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    // ===== REGISTER =====
    public function create($data)
    {
        // check email tồn tại
        $check = $this->findByEmail($data['email']);
        if ($check) {
            return false; // báo lỗi
        }

        $stmt = $this->conn->prepare("
        INSERT INTO users(full_name, email, password, role)
        VALUES(?,?,?,?)
    ");

        return $stmt->execute([
            $data['full_name'],
            $data['email'],
            password_hash($data['password'], PASSWORD_DEFAULT),
            'user'
        ]);
    }
}
