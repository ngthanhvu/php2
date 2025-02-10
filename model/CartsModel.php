<?php
require_once "Database.php";

class CartsModel extends Database
{
    public function  __construct()
    {
        parent::getConnection();
    }

    public function getAllCarts($user_id, $cart_session)
    {
        $condition = !empty($user_id) ? "user_id = :user_id" : "cart_session = :cart_session";
        $stmt = $this->conn->prepare("SELECT * FROM carts WHERE $condition");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':cart_session', $cart_session);
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
}
