<?php
require_once __DIR__ . '/../commons/function.php';

class ProductModel {
    private $conn;

    public function __construct() {
        $this->conn = connectDB();
    }

    public function all() {
        $stmt = $this->conn->prepare("SELECT * FROM products ORDER BY id DESC");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function find($id) {
        $stmt = $this->conn->prepare("SELECT * FROM products WHERE id=?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create($data) {
        $stmt = $this->conn->prepare("INSERT INTO products(name, price, image) VALUES(?,?,?)");
        return $stmt->execute([
            $data['name'],
            $data['price'],
            $data['image']
        ]);
    }

    public function update($data) {
        $stmt = $this->conn->prepare("UPDATE products SET name=?, price=?, image=? WHERE id=?");
        return $stmt->execute([
            $data['name'],
            $data['price'],
            $data['image'],
            $data['id']
        ]);
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM products WHERE id=?");
        return $stmt->execute([$id]);
    }
}
