<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class SettingModel
{
    private $conn;
    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getSetting()
    {
        $query = "SELECT * FROM settings";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($banner)
    {
        $query = "INSERT INTO settings (banner) VALUES (:banner)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':banner', $banner);
        return $stmt->execute();
    }
}
