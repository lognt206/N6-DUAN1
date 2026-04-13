<?php
require_once __DIR__ . '/../commons/function.php';

class UserModel
{
    private $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    // ===== LẤY TẤT CẢ USER =====
    public function all()
    {
        $stmt = $this->conn->prepare("
            SELECT * FROM users 
            ORDER BY id DESC
        ");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // ===== LẤY USER (KHÔNG PHẢI ADMIN) =====
    public function getUsers()
    {
        $stmt = $this->conn->prepare("
            SELECT * FROM users 
            WHERE role = 'user'
            ORDER BY id DESC
        ");
        $stmt->execute();
        return $stmt->fetchAll();
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
            return false;
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

    // ===== LẤY THEO ID =====
    public function find($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE id=?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // ===== UPDATE USER =====
    public function update($data)
    {
        $stmt = $this->conn->prepare("
            UPDATE users 
            SET 
                full_name = ?, 
                email = ?, 
                phone = ?, 
                address = ?
            WHERE id = ?
        ");

        return $stmt->execute([
            $data['full_name'] ?? null,
            $data['email'] ?? null,
            $data['phone'] ?? null,
            $data['address'] ?? null,
            $data['id']
        ]);
    }

    // ===== XÓA USER =====
    public function delete($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM users WHERE id=?");
        return $stmt->execute([$id]);
    }
}