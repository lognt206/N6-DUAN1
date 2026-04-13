<?php
require_once __DIR__ . '/../commons/function.php';

class OrderModel
{
    private $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    // ===== ADMIN: LẤY TẤT CẢ ĐƠN =====
    public function all()
    {
        $sql = "SELECT o.*, 
                   COALESCE(o.customer_name, u.full_name) as display_name
            FROM orders o
            LEFT JOIN users u ON o.user_id = u.id
            ORDER BY o.id DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // ===== TÌM 1 ĐƠN =====
    public function find($id)
    {
        $stmt = $this->conn->prepare("
        SELECT o.*, 
               COALESCE(o.customer_name, u.full_name) as display_name
        FROM orders o
        LEFT JOIN users u ON o.user_id = u.id
        WHERE o.id=?
    ");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // ===== UPDATE TRẠNG THÁI =====
    public function updateStatus($id, $status)
    {
        $stmt = $this->conn->prepare("
            UPDATE orders 
            SET status=? 
            WHERE id=?
        ");
        return $stmt->execute([$status, $id]);
    }

    // ===== XÓA ĐƠN =====
    public function delete($id)
    {
        // xóa chi tiết trước
        $this->conn->prepare("
            DELETE FROM order_items 
            WHERE order_id=?
        ")->execute([$id]);

        // xóa đơn
        return $this->conn->prepare("
            DELETE FROM orders 
            WHERE id=?
        ")->execute([$id]);
    }

    // ===== CHI TIẾT ĐƠN =====
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

    // ===== TẠO ĐƠN =====
    public function createOrder($data)
    {
        $total = 0;

        foreach ($data['cart'] as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $stmt = $this->conn->prepare("
        INSERT INTO orders(user_id, customer_name, phone, address, total_price, status)
        VALUES(?,?,?,?,?,?)
    ");

        $stmt->execute([
            $data['user_id'] ?? null,
            $data['customer_name'], // ✅ THÊM DÒNG NÀY
            $data['phone'],
            $data['address'],
            $total,
            'pending'
        ]);

        $order_id = $this->conn->lastInsertId();

        foreach ($data['cart'] as $product_id => $item) {
            $stmt = $this->conn->prepare("
            INSERT INTO order_items(order_id, product_id, price, quantity)
            VALUES(?,?,?,?)
        ");
            $stmt->execute([
                $order_id,
                $product_id,
                $item['price'],
                $item['quantity']
            ]);
        }

        return $order_id;
    }

    // ===== USER: LỊCH SỬ ĐƠN =====
    public function getByUser($user_id)
    {
        $stmt = $this->conn->prepare("
            SELECT * FROM orders 
            WHERE user_id=? 
            ORDER BY id DESC
        ");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll();
    }
    public function getLatestOrders()
    {
        $sql = "SELECT o.*, 
                   COALESCE(o.customer_name, u.full_name) as display_name
            FROM orders o
            LEFT JOIN users u ON o.user_id = u.id
            ORDER BY o.id DESC
            LIMIT 5";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function getRevenue()
    {
        $stmt = $this->conn->prepare("
        SELECT SUM(total_price) as total 
        FROM orders 
        WHERE status = 'completed'
    ");
        $stmt->execute();
        return $stmt->fetch()['total'] ?? 0;
    }
    public function getRevenueByMonth()
    {
        $stmt = $this->conn->prepare("
        SELECT DATE_FORMAT(created_at, '%m/%Y') as month,
               SUM(total_price) as revenue
        FROM orders
        WHERE status = 'completed'
        GROUP BY month
        ORDER BY MIN(created_at)
    ");
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function getTopProducts()
    {
        $stmt = $this->conn->prepare("
        SELECT p.name, SUM(oi.quantity) as sold
        FROM order_items oi
        JOIN products p ON oi.product_id = p.id
        GROUP BY oi.product_id
        ORDER BY sold DESC
        LIMIT 5
    ");
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
