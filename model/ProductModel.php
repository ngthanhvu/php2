<?php

namespace App\Models;

use App\Core\Database;
use PDO;
use Exception;

class ProductModel
{
  private $conn;

  public function __construct()
  {
    $database = new Database();
    $this->conn = $database->getConnection();
  }

  public function getAllProducts()
  {
    $query = "SELECT products.*, categories.name AS category_name 
        FROM products 
        JOIN categories ON products.categories_id = categories.id";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getProductById($id)
  {
    $query = "SELECT products.*, categories.name AS category_name
        FROM products
        JOIN categories ON products.categories_id = categories.id
        WHERE products.id = :id";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function filterProducts($category_id = null, $min_price = null, $max_price = null)
  {
    $query = "SELECT products.*, categories.name AS category_name 
              FROM products 
              JOIN categories ON products.categories_id = categories.id WHERE 1=1";

    if (!empty($category_id)) {
      $query .= " AND categories.id = :category_id";
    }

    if (!empty($min_price)) {
      $query .= " AND products.price >= :min_price";
    }

    if (!empty($max_price)) {
      $query .= " AND products.price <= :max_price";
    }

    $stmt = $this->conn->prepare($query);

    if (!empty($category_id)) {
      $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
    }

    if (!empty($min_price)) {
      $stmt->bindParam(':min_price', $min_price, PDO::PARAM_INT);
    }

    if (!empty($max_price)) {
      $stmt->bindParam(':max_price', $max_price, PDO::PARAM_INT);
    }

    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }


  public function getProductsByCategory($id)
  {
    $query = "SELECT * FROM products WHERE categories_id = :id";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function searchProducts($keyword)
  {
    $query = "SELECT products.*, categories.name AS category_name 
              FROM products 
              JOIN categories ON products.categories_id = categories.id
              WHERE products.name LIKE :keyword";
    $stmt = $this->conn->prepare($query);
    $keyword = "%$keyword%";
    $stmt->bindParam(':keyword', $keyword, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getPaginatedProducts($limit, $offset)
  {
    $query = "SELECT products.*, categories.name AS category_name 
              FROM products 
              JOIN categories ON products.categories_id = categories.id
              LIMIT :limit OFFSET :offset";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getTotalProducts()
  {
    $query = "SELECT COUNT(*) as total FROM products";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
  }

  public function addProductWithImages($name, $price, $description, $image, $quantity, $sku, $categories_id, $sub_images = [])
  {
    try {
      $this->conn->beginTransaction();

      $query = "INSERT INTO products (name, price, description, image, quantity, sku, categories_id) 
                  VALUES (:name, :price, :description, :image, :quantity, :sku, :categories_id)";
      $stmt = $this->conn->prepare($query);
      $stmt->bindParam(':name', $name);
      $stmt->bindParam(':price', $price);
      $stmt->bindParam(':description', $description);
      $stmt->bindParam(':image', $image);
      $stmt->bindParam(':quantity', $quantity);
      $stmt->bindParam(':sku', $sku);
      $stmt->bindParam(':categories_id', $categories_id);

      if (!$stmt->execute()) {
        throw new Exception("Failed to insert product.");
      }

      $product_id = $this->conn->lastInsertId();

      if (!empty($sub_images)) {
        $queryImages = "INSERT INTO products_images (product_id, sub_image) VALUES (:product_id, :sub_image)";
        $stmtImage = $this->conn->prepare($queryImages);

        foreach ($sub_images as $sub_image) {
          $stmtImage->bindValue(':product_id', $product_id, PDO::PARAM_INT);
          $stmtImage->bindValue(':sub_image', $sub_image, PDO::PARAM_STR);
          if (!$stmtImage->execute()) {
            throw new Exception("Failed to insert product images.");
          }
        }
      }

      $this->conn->commit();
      return $product_id;
    } catch (Exception $e) {
      $this->conn->rollBack();
      return false;
    }
  }

  public function updateProduct($id, $name, $price, $description, $image, $quantity, $categories_id)
  {
    $query = "UPDATE products SET name = :name, price = :price, description = :description, image = :image, quantity = :quantity, categories_id = :categories_id WHERE id = :id";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':image', $image);
    $stmt->bindParam(':quantity', $quantity);
    $stmt->bindParam(':categories_id', $categories_id);
    return $stmt->execute();
  }

  public function deleteProduct($id)
  {
    $query = "DELETE FROM products WHERE id = :id";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':id', $id);
    return $stmt->execute();
  }

  public function getQuanityProductBySku($sku)
  {
    $query = "SELECT quantity FROM products WHERE sku = :sku";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':sku', $sku);
    $stmt->execute();
    return $stmt->fetchColumn();
  }

  public function UpdateQuanityAfterBuy($id, $quantity)
  {
    $query = "UPDATE products SET quantity = quantity - :quantity WHERE id = :id";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':quantity', $quantity);
    return $stmt->execute();
  }

  public function RelatedProducts($id)
  {
    $query = "SELECT products.*, categories.name AS category_name 
              FROM products 
              JOIN categories ON products.categories_id = categories.id 
              WHERE products.categories_id = :id 
              LIMIT 4";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function increaseProductQuantity($product_id, $quantity)
  {
    $query = "UPDATE products SET quantity = quantity + :quantity WHERE id = :product_id";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
    $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
    return $stmt->execute();
  }
}
