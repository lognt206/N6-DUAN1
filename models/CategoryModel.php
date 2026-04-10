<?php
require_once __DIR__ . '/../commons/function.php';

class CategoryModel
{
    private $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function all()
    {
        $sql = "SELECT c.*, 
                (SELECT COUNT(*) FROM products p WHERE p.category_id = c.id) as total_products
                FROM categories c
                ORDER BY c.id DESC";

        return $this->conn->query($sql)->fetchAll();
    }

    public function find($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM categories WHERE id=?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create($data)
    {
        $stmt = $this->conn->prepare("INSERT INTO categories(name) VALUES(?)");
        return $stmt->execute([$data['name']]);
    }

    public function update($data)
    {
        $stmt = $this->conn->prepare("UPDATE categories SET name=? WHERE id=?");
        return $stmt->execute([$data['name'], $data['id']]);
    }

    public function delete($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM categories WHERE id=?");
        return $stmt->execute([$id]);
    }
}