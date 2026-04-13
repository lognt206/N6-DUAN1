<?php
require_once __DIR__ . '/../commons/function.php';

class CustomerModel
{
    private $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    // ===== DANH SÁCH KHÁCH + SỐ ĐƠN =====
    public function all()
    {
        $sql = "
            SELECT c.*, 
                   COUNT(o.id) AS total_orders,
                   COALESCE(SUM(o.total_price), 0) AS total_spent
            FROM customers c
            LEFT JOIN orders o ON o.user_id = c.id
            GROUP BY c.id
            ORDER BY c.id DESC
        ";

        return $this->conn->query($sql)->fetchAll();
    }

    // ===== CHI TIẾT KHÁCH =====
    public function find($id)
    {
        $stmt = $this->conn->prepare("
            SELECT c.*, 
                   COUNT(o.id) AS total_orders,
                   COALESCE(SUM(o.total_price), 0) AS total_spent
            FROM customers c
            LEFT JOIN orders o ON o.user_id = c.id
            WHERE c.id = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // ===== UPDATE =====
    public function update($data)
    {
        $stmt = $this->conn->prepare("
            UPDATE customers 
            SET name=?, phone=?, email=?, address=? 
            WHERE id=?
        ");

        return $stmt->execute([
            $data['name'],
            $data['phone'],
            $data['email'],
            $data['address'],
            $data['id']
        ]);
    }

    // ===== DELETE =====
    public function delete($id)
    {
        // ❗ nếu có đơn thì không cho xoá (chuẩn web thật)
        $check = $this->conn->prepare("
            SELECT COUNT(*) FROM orders WHERE user_id=?
        ");
        $check->execute([$id]);

        if ($check->fetchColumn() > 0) {
            return false; // có đơn -> không xoá
        }

        $stmt = $this->conn->prepare("DELETE FROM customers WHERE id=?");
        return $stmt->execute([$id]);
    }
}