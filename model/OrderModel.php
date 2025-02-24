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

    public function createOrder($user_id, $status, $payment_method, $total_amount, $compact_address, $code)
    {
        $this->conn->beginTransaction();

        try {
            $sql = "INSERT INTO orders (user_id, status, payment_method, total_amount, shipping_address, code) 
                VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$user_id, $status, $payment_method, $total_amount, $compact_address, $code]);

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

                    // Kiểm tra số lượng trong products_variants
                    $sql = "SELECT quantity FROM products_variants WHERE id = ?";
                    $stmt = $this->conn->prepare($sql);
                    $stmt->execute([$variant_id]);
                    $variant_quantity = $stmt->fetchColumn();

                    if ($variant_quantity < $item['quantity']) {
                        throw new Exception("Số lượng biến thể (SKU: {$item['sku']}) không đủ, chỉ còn: $variant_quantity.");
                    }

                    // Trừ số lượng trong products_variants
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

                // Kiểm tra số lượng trong products
                $sql = "SELECT quantity FROM products WHERE id = ?";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute([$products_id]);
                $product_quantity = $stmt->fetchColumn();

                if ($product_quantity < $item['quantity']) {
                    throw new Exception("Số lượng sản phẩm (ID: $products_id) không đủ, chỉ còn: $product_quantity.");
                }

                // Trừ số lượng trong products
                $productModel->UpdateQuanityAfterBuy($products_id, $item['quantity']);

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
}
