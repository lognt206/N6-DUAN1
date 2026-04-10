<?php
require_once __DIR__ . '/../commons/function.php';

class CustomerModel
{
    private $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function all()
    {
        $stmt = $this->conn->prepare("SELECT * FROM customers ORDER BY id DESC");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function find($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM customers WHERE id=?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

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

    public function delete($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM customers WHERE id=?");
        return $stmt->execute([$id]);
    }
}