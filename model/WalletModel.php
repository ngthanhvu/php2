<?php
require_once "Database.php";

class WalletModel
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getWallet($user_id)
    {
        $sql = "SELECT * FROM wallet WHERE user_id = :user_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createWallet($user_id, $amount, $payment_method)
    {
        $sql = "INSERT INTO wallet (user_id, amount, payment_method) VALUES (:user_id, :amount, :payment_method)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->bindParam(":amount", $amount);
        $stmt->bindParam(":payment_method", $payment_method);
        $stmt->execute();
    }
}
?>
