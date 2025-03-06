<?php

namespace App\Models;

use App\Core\Database;
use PDO;


class CartsModel
{
    private $conn;

    public function  __construct()
    {
        $this->conn = new Database();
        $this->conn = $this->conn->getConnection();
    }

    public function getAllCarts($user_id, $cart_session)
    {
        if (!empty($user_id)) {
            $updateQuery = "UPDATE carts SET user_id = :user_id WHERE cart_session = :cart_session AND user_id IS NULL";
            $updateStmt = $this->conn->prepare($updateQuery);
            $updateStmt->bindParam(':user_id', $user_id);
            $updateStmt->bindParam(':cart_session', $cart_session);
            $updateStmt->execute();
        }
        $condition = !empty($user_id) ? "c.user_id = :user_id" : "c.cart_session = :cart_session";

        // $query = "SELECT 
        //         c.*, 
        //         COALESCE(pv.image, p.image) AS product_image, 
        //         p.name AS product_name,
        //         COALESCE(s.name, 'Không có') AS product_size,
        //         COALESCE(cl.name, 'Không có') AS product_color
        //     FROM carts c
        //     LEFT JOIN products_variants pv 
        //         ON c.sku = pv.sku COLLATE utf8mb4_general_ci
        //     LEFT JOIN products p 
        //         ON (pv.product_id = p.id OR c.sku = p.sku COLLATE utf8mb4_general_ci)
        //     LEFT JOIN size s 
        //         ON pv.size_id = s.id
        //     LEFT JOIN color cl 
        //         ON pv.color_id = cl.id
        //     WHERE $condition";

        $query = "SELECT 
    c.*, 
    c.quantity AS cart_quantity, -- Số lượng trong giỏ hàng từ bảng carts
    pv.quantity AS variant_quantity, -- Số lượng tồn kho từ bảng products_variants
    p.quantity AS product_quantity, -- Số lượng tồn kho từ bảng products
    COALESCE(pv.image, p.image) AS product_image, 
    p.name AS product_name,
    COALESCE(s.name, 'Không có') AS product_size,
    COALESCE(cl.name, 'Không có') AS product_color
FROM carts c
LEFT JOIN products_variants pv 
    ON c.sku = pv.sku COLLATE utf8mb4_general_ci
LEFT JOIN products p 
    ON (pv.product_id = p.id OR c.sku = p.sku COLLATE utf8mb4_general_ci)
LEFT JOIN size s 
    ON pv.size_id = s.id
LEFT JOIN color cl 
    ON pv.color_id = cl.id
WHERE $condition";

        $stmt = $this->conn->prepare($query);
        if (!empty($user_id)) {
            $stmt->bindParam(':user_id', $user_id);
        } else {
            $stmt->bindParam(':cart_session', $cart_session);
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addCart($user_id, $cart_session, $sku, $quantity, $price)
    {
        $stmt = $this->conn->prepare("INSERT INTO carts (user_id, cart_session, sku, quantity, price) VALUES (:user_id, :cart_session, :sku, :quantity, :price)");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':cart_session', $cart_session);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':sku', $sku);
        $stmt->bindParam(':price', $price);
        return $stmt->execute();
    }

    public function updateQuantityCart($id, $quantity)
    {
        $stmt = $this->conn->prepare("UPDATE carts SET quantity = :quantity WHERE id = :id");
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function deleteCart($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM carts WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function deleteAllCart($user_id, $cart_session)
    {
        $condition = !empty($user_id) ? "user_id = :user_id" : "cart_session = :cart_session";
        $stmt = $this->conn->prepare("DELETE FROM carts WHERE $condition");
        if (!empty($user_id)) {
            $stmt->bindParam(':user_id', $user_id);
        } else {
            $stmt->bindParam(':cart_session', $cart_session);
        }
        return $stmt->execute();
    }

    public function getCartBySku($user_id, $cart_session, $sku)
    {
        $query = "SELECT * FROM carts WHERE sku = ? AND (user_id = ? OR cart_session = ?) LIMIT 1";
        $stmt = $this->conn->prepare($query); // Giả sử $this->db là kết nối database
        $stmt->execute([$sku, $user_id, $cart_session]);
        return $stmt->fetch(PDO::FETCH_ASSOC); // Trả về false nếu không tìm thấy
    }

    public function updateCartQuantity($cart_id, $quantity)
    {
        $query = "UPDATE carts SET quantity = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$quantity, $cart_id]);
    }
}
