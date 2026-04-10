<?php
require_once __DIR__ . '/../commons/function.php';

class ProductModel
{
    private $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    // Lấy tất cả sản phẩm + tên danh mục
    public function all()
    {
        $sql = "SELECT p.*, c.name AS category_name
                FROM products p
                LEFT JOIN categories c ON p.category_id = c.id
                ORDER BY p.id DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // 🔥 FIX
    }

    // Tìm 1 sản phẩm
    public function find($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM products WHERE id=?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC); // 🔥 FIX
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

    // Xóa
    public function delete($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM products WHERE id=?");
        return $stmt->execute([$id]);
    }

    // Đếm
    public function countProducts()
    {
        $stmt = $this->conn->prepare("SELECT COUNT(*) as total FROM products");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC); // 🔥 FIX
        return $result['total'];
    }
}