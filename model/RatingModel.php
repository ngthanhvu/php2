<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class RatingModel
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function addRating($productId, $userId, $rating, $comment = null)
    {
        $query = "INSERT INTO ratings (product_id, user_id, rating, comment) VALUES (:product_id, :user_id, :rating, :comment)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':product_id', $productId, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':rating', $rating, PDO::PARAM_INT);
        $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function getRatingsByProduct($productId)
    {
        $query = "SELECT r.*, u.username 
                    FROM ratings r 
                    JOIN users u ON r.user_id = u.id 
                    WHERE r.product_id = :product_id 
                    ORDER BY r.created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':product_id', $productId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAverageRating($productId)
    {
        $query = "SELECT AVG(rating) as average 
                    FROM ratings 
                    WHERE product_id = :product_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':product_id', $productId, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['average'] ? round($result['average'], 1) : 0;
    }

    public function deleteRating($id, $userId)
    {
        $query = "DELETE FROM ratings WHERE id = :id AND user_id = :user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function addFavorite($id, $favorite)
    {
        $query = "UPDATE ratings SET favorite = :favorite WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':favorite', $favorite, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
