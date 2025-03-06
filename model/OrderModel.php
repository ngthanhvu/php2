<?php

namespace App\Models;

use App\Core\Database;
use PDO;
use Exception;

class OrderModel
{
    private $conn;

    public function  __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function saveAddress($user_id, $full_name, $phone, $address)
    {
        $sql = "INSERT INTO address (user_id, full_name, phone, address) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$user_id, $full_name, $phone, $address]);
        return $this->conn->lastInsertId();
    }

    public function getAllOrders()
    {
        $sql = "SELECT * FROM orders ORDER BY id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOrderByUserId($user_id)
    {
        $sql = "SELECT * FROM orders WHERE user_id = ? ORDER BY id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOrderById($id)
    {
        $sql = "SELECT * FROM orders WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createOrder($user_id, $status, $payment_method, $total_amount, $address_id, $new_address_data, $code)
    {
        $this->conn->beginTransaction();

        try {
            if (!empty($new_address_data)) {
                $address_id = $this->saveAddress(
                    $user_id,
                    $new_address_data['name'],
                    $new_address_data['phone'],
                    $new_address_data['address']
                );
            }

            $sql = "SELECT full_name, phone, address FROM address WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$address_id]);
            $address = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$address) {
                throw new Exception("Không tìm thấy địa chỉ với ID: $address_id");
            }

            $compact_address = "{$address['full_name']}, {$address['phone']}, {$address['address']}, " . $new_address_data['email'];

            $sql = "INSERT INTO orders (user_id, status, payment_method, total_amount, shipping_address, code) 
                    VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$user_id, $status, $payment_method, $total_amount, $compact_address, $code]);

            $order_id = $this->conn->lastInsertId();

            $sql = "SELECT sku, quantity, price FROM carts WHERE user_id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$user_id]);
            $cart_items = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (empty($cart_items)) {
                throw new Exception("Giỏ hàng trống, không thể tạo đơn hàng.");
            }

            $productModel = new ProductModel();
            $variantModel = new ProductsVarriantModel();

            foreach ($cart_items as $item) {
                $sql = "SELECT product_id, id AS variant_id FROM products_variants WHERE sku = ?";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute([$item['sku']]);
                $product_variant = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($product_variant) {
                    $products_id = $product_variant['product_id'];
                    $variant_id = $product_variant['variant_id'];

                    $sql = "SELECT quantity FROM products_variants WHERE id = ?";
                    $stmt = $this->conn->prepare($sql);
                    $stmt->execute([$variant_id]);
                    $variant_quantity = $stmt->fetchColumn();

                    if ($variant_quantity < $item['quantity']) {
                        throw new Exception("Số lượng biến thể (SKU: {$item['sku']}) không đủ, chỉ còn: $variant_quantity.");
                    }

                    $variantModel->UpdateQuantityAfterBuy($variant_id, $item['quantity']);
                } else {
                    $sql = "SELECT id FROM products WHERE sku = ?";
                    $stmt = $this->conn->prepare($sql);
                    $stmt->execute([$item['sku']]);
                    $product = $stmt->fetch(PDO::FETCH_ASSOC);

                    if ($product) {
                        $products_id = $product['id'];
                        $variant_id = null;
                    } else {
                        throw new Exception("Không tìm thấy sản phẩm với SKU: " . $item['sku']);
                    }
                }

                $sql = "SELECT quantity FROM products WHERE id = ?";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute([$products_id]);
                $product_quantity = $stmt->fetchColumn();

                if ($product_quantity < $item['quantity']) {
                    throw new Exception("Số lượng sản phẩm (ID: $products_id) không đủ, chỉ còn: $product_quantity.");
                }

                $productModel->UpdateQuanityAfterBuy($products_id, $item['quantity']);

                $sql = "INSERT INTO orders_detail (orders_id, products_id, variant_id, quantity, price, sku) 
                        VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute([$order_id, $products_id, $variant_id, $item['quantity'], $item['price'], $item['sku']]);
            }

            $sql = "DELETE FROM carts WHERE user_id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$user_id]);

            $this->conn->commit();

            return $order_id;
        } catch (Exception $e) {
            $this->conn->rollBack();
            die("Lỗi khi tạo đơn hàng: " . $e->getMessage());
        }
    }

    public function updateOrder($order_id, $status)
    {
        $sql = "UPDATE orders SET status = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$status, $order_id]);

        $sql = "SELECT shipping_address FROM orders WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$order_id]);
        $shipping_address = $stmt->fetchColumn();

        return $shipping_address;
    }

    public function detailOrder($code)
    {
        $sql = "SELECT * FROM orders WHERE code = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$code]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getOrderDetailsById($order_id)
    {
        $sql = "SELECT products_id AS id, quantity FROM orders_detail WHERE orders_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$order_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCountOrders()
    {
        $sql = "SELECT COUNT(*) as total FROM orders";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function sumOrders()
    {
        $sql = "SELECT SUM(total_amount) as total FROM orders";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function getMonthlyRevenue()
    {
        $sql = "SELECT MONTH(created_at) as month, SUM(total_amount) as revenue 
            FROM orders 
            WHERE status = 'completed' 
            GROUP BY MONTH(created_at) 
            ORDER BY MONTH(created_at) DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMonthlyOrders()
    {
        $sql = "SELECT MONTH(created_at) as month, COUNT(*) as total_orders 
            FROM orders 
            GROUP BY MONTH(created_at) 
            ORDER BY MONTH(created_at) DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
