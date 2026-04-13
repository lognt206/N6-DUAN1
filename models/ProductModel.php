<?php
require_once __DIR__ . '/../commons/function.php';

class ProductModel
{
    private $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    // ================= ADMIN =================

    // Lấy tất cả sản phẩm (admin thấy cả ngừng bán)
    public function all()
    {
        $sql = "SELECT p.*, c.name AS category_name
                FROM products p
                LEFT JOIN categories c ON p.category_id = c.id
                ORDER BY p.id DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ================= CLIENT =================

    // 🔥 CHỈ LẤY SẢN PHẨM ĐANG BÁN
    public function getActiveProducts()
    {
        $sql = "SELECT p.*, c.name AS category_name
                FROM products p
                LEFT JOIN categories c ON p.category_id = c.id
                WHERE p.status = 1
                ORDER BY p.id DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ================= CHUNG =================

    // Tìm 1 sản phẩm
    public function find($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM products WHERE id=?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Thêm
    public function create($data)
    {
        $stmt = $this->conn->prepare("
            INSERT INTO products(name, price, quantity, unit, category_id, description, status, image)
            VALUES(?,?,?,?,?,?,?,?)
        ");

        return $stmt->execute([
            $data['name'],
            $data['price'],
            $data['quantity'],
            $data['unit'],
            $data['category_id'],
            $data['description'],
            $data['status'],
            $data['image']
        ]);
    }

    // Cập nhật
    public function update($data)
    {
        $stmt = $this->conn->prepare("
            UPDATE products 
            SET name=?, price=?, quantity=?, unit=?, category_id=?, description=?, status=?, image=? 
            WHERE id=?
        ");

        return $stmt->execute([
            $data['name'],
            $data['price'],
            $data['quantity'],
            $data['unit'],
            $data['category_id'],
            $data['description'],
            $data['status'],
            $data['image'],
            $data['id']
        ]);
    }

    // ================= SOFT DELETE =================

    // ❌ XÓA THẬT -> ❌ BỎ
    // ✅ NGỪNG BÁN
    public function delete($id)
    {
        $stmt = $this->conn->prepare("UPDATE products SET status = 0 WHERE id=?");
        return $stmt->execute([$id]);
    }

    // ♻️ BÁN LẠI
    public function restore($id)
    {
        $stmt = $this->conn->prepare("UPDATE products SET status = 1 WHERE id=?");
        return $stmt->execute([$id]);
    }

    // ================= THỐNG KÊ =================

    public function countProducts()
    {
        $stmt = $this->conn->prepare("SELECT COUNT(*) as total FROM products");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }
}