<?php

namespace App\Core;

session_start();
require_once __DIR__ . '/../env.php'; // Đảm bảo đường dẫn chính xác

class Database
{
    protected $conn;

    public function __construct()
    {
        // Load .env
        if (function_exists('loadEnv')) {
            loadEnv();
        } else {
            die("Function loadEnv() not found. Check env.php.");
        }
    }

    public function getConnection()
    {
        $this->conn = null;

        try {
            $this->conn = new \PDO(
                "mysql:host=" . $_ENV['DB_HOST'] . ";dbname=" . $_ENV['DB_NAME'],
                $_ENV['DB_USER'],
                $_ENV['DB_PASS']
            );
            $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
