<?php
require_once "Database.php";

class OrderModel extends Database
{
    public function __construct()
    {
        parent::getConnection();
    }

    public function getAllOrders()
    {
        $sql = "SELECT * FROM orders ORDER BY id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createOrder($user_id, $status, $payment_method, $total_amount, $compact_address)
    {
        $this->conn->beginTransaction();

        try {
            $sql = "INSERT INTO orders (user_id, status, payment_method, total_amount, shipping_address) 
                VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$user_id, $status, $payment_method, $total_amount, $compact_address]);

            $order_id = $this->conn->lastInsertId();
            var_dump("Order ID:", $order_id);

            $sql = "SELECT sku, quantity, price FROM carts WHERE user_id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$user_id]);
            $cart_items = $stmt->fetchAll(PDO::FETCH_ASSOC);
            var_dump("Cart Items:", $cart_items);

            if (empty($cart_items)) {
                throw new Exception("Giỏ hàng trống, không thể tạo đơn hàng.");
            }

            foreach ($cart_items as $item) {
                $sql = "SELECT product_id, id as variant_id FROM products_variants WHERE sku = ?";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute([$item['sku']]);
                $product_variant = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($product_variant) {
                    $products_id = $product_variant['product_id'];
                    $variant_id = $product_variant['variant_id'];
                } else {
                    $sql = "SELECT id FROM products WHERE sku = ?";
                    $stmt = $this->conn->prepare($sql);
                    $stmt->execute([$item['sku']]);
                    $product = $stmt->fetch(PDO::FETCH_ASSOC);

                    if ($product) {
                        $products_id = $product['id'];
                        $variant_id = 0;
                    } else {
                        throw new Exception("Không tìm thấy sản phẩm với SKU: " . $item['sku']);
                    }
                }

                $sql = "INSERT INTO orders_detail (orders_id, products_id, variant_id, quantity, price, sku) 
                    VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute([$order_id, $products_id, $variant_id, $item['quantity'], $item['price'], $item['sku']]);

                var_dump("Inserted into orders_detail:", $item['sku']);
            }

            $sql = "DELETE FROM carts WHERE user_id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$user_id]);
            var_dump("Deleted cart for user:", $user_id);

            $this->conn->commit();

            return $order_id;
        } catch (Exception $e) {
            $this->conn->rollBack();
            die("Lỗi khi tạo đơn hàng: " . $e->getMessage());
        }
    }
}
