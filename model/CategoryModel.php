<?php
require_once 'Database.php';

class  CategoryModel
{
    private $conn;

    public function __construct()
    {
        $this->conn = new Database();
    }

    public function index()
    {
        $query = "SELECT * FROM categories";
        $stmt = $this->conn->getConnection()->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getCategoryById($id)
    {
        $query = "SELECT * FROM categories WHERE id = :id";
        $stmt = $this->conn->getConnection()->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function create()
    {
        $query = "INSERT INTO categories (name) VALUES (:name)";
        $stmt = $this->conn->getConnection()->prepare($query);
        $stmt->bindParam(':name', $_POST['name']);
        return $stmt->execute();
    }

    public function update($id)
    {
        $query = "UPDATE categories SET name = :name WHERE id = :id";
        $stmt = $this->conn->getConnection()->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $_POST['name']);
        return $stmt->execute();
    }

    public function delete($id)
    {
        $query = "DELETE FROM categories WHERE id = :id";
        $stmt = $this->conn->getConnection()->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
