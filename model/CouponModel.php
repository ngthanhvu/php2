<?php

namespace App\Models;

use App\Core\Database;
use PDO;


class CouponModel
{
    private $conn;
    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }
    public function getAllCoupons()
    {
        $query = "SELECT * FROM coupons";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCouponByCode($code)
    {
        $query = "SELECT * FROM coupons WHERE code = :code";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':code', $code);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getCouponById($id)
    {
        $query = "SELECT * FROM coupons WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($code, $discount, $type, $expiry_date)
    {
        $query = "INSERT INTO coupons (code, discount, type, expiry_date) VALUES (:code, :discount, :type, :expiry_date)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':code', $code);
        $stmt->bindParam(':discount', $discount);
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':expiry_date', $expiry_date);
        return $stmt->execute();
    }

    public function update($id, $code, $discount, $type, $expiry_date, $status)
    {
        $query = "UPDATE coupons SET code = :code, discount = :discount, type = :type, expiry_date = :expiry_date, status = :status WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':code', $code);
        $stmt->bindParam(':discount', $discount);
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':expiry_date', $expiry_date);
        $stmt->bindParam(':status', $status);
        return $stmt->execute();
    }

    public function delete($id)
    {
        $query = "DELETE FROM coupons WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
