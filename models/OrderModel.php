<?php
require_once __DIR__ . '/../commons/function.php';

class OrderModel
{
    private $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function all()
    {
        $stmt = $this->conn->prepare("SELECT * FROM orders ORDER BY id DESC");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function find($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM orders WHERE id=?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function updateStatus($id, $status)
    {
        $stmt = $this->conn->prepare("UPDATE orders SET status=? WHERE id=?");
        return $stmt->execute([$status, $id]);
    }

    public function delete($id)
    {
        $this->conn->prepare("DELETE FROM order_items WHERE order_id=?")->execute([$id]);
        return $this->conn->prepare("DELETE FROM orders WHERE id=?")->execute([$id]);
    }

    public function getItems($order_id)
    {
        $sql = "SELECT oi.*, p.name 
                FROM order_items oi
                JOIN products p ON oi.product_id = p.id
                WHERE oi.order_id=?";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$order_id]);
        return $stmt->fetchAll();
    }
}