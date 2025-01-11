<?php
require_once 'Database.php';

class PostModel
{
    private $conn;

    public function __construct()
    {
        $this->conn = new Database();
    }

    public function getAllPosts()
    {
        $query = "SELECT * FROM posts";
        $stmt = $this->conn->getConnection()->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getPostById($id)
    {
        $query = "SELECT * FROM posts WHERE id = :id";
        $stmt = $this->conn->getConnection()->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function createPost($title, $content)
    {
        $query = "INSERT INTO posts (title, content) VALUES (:title, :content)";
        $stmt = $this->conn->getConnection()->prepare($query);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        return $stmt->execute();
    }

    public function updatePost($id, $title, $content)
    {
        $query = "UPDATE posts SET title = :title, content = :content WHERE id = :id";
        $stmt = $this->conn->getConnection()->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        return $stmt->execute();
    }

    public function deletePost($id)
    {
        $query = "DELETE FROM posts WHERE id = :id";
        $stmt = $this->conn->getConnection()->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
