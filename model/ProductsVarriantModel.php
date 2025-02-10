<?php
require_once "Database.php";

class ProductsVarriantModel
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function checkExitsColorAndSize($color_id, $size_id)
    {
        $query = "SELECT * FROM products_variants WHERE color_id = :color_id AND size_id = :size_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':color_id', $color_id);
        $stmt->bindParam(':size_id', $size_id);
        $stmt->execute();
        return ($stmt->fetchColumn() > 0);
    }

    public function createProductVariant($product_id, $price, $quantity, $sku, $image, $color_id, $size_id)
    {
        $query = "INSERT INTO products_variants (product_id, price, quantity, sku, image, color_id, size_id) VALUES (:product_id, :price, :quantity, :sku, :image, :color_id, :size_id)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':product_id', $product_id);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':sku', $sku);
        $stmt->bindParam(':color_id', $color_id);
        $stmt->bindParam(':size_id', $size_id);
        return $stmt->execute();
    }

    public function getAllProductVariants()
    {
        // $query = "SELECT * FROM products_variants JOIN products ON products_variants.product_id = products.id";
        $query = "SELECT 
                    products_variants.id AS variant_id, 
                    products_variants.product_id, 
                    products_variants.quantity AS variant_quantity, 
                    products_variants.sku AS variant_sku,
                    products_variants.image AS variant_image, 
                    products_variants.price AS variant_price, 
                    products.id AS product_id, 
                    products.name AS product_name, 
                    products.quantity AS product_quantity, 
                    products.image AS product_image, 
                    products.price AS product_price,
                    color.name AS color_name,
                    size.name AS size_name
                    FROM products_variants
                    JOIN products ON products_variants.product_id = products.id
                    LEFT JOIN color ON products_variants.color_id = color.id
                    LEFT JOIN size ON products_variants.size_id = size.id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllProductVariantsById($id)
    {
        $query = "SELECT 
            products_variants.*, 
            color.name AS color_name, 
            size.name AS size_name
            FROM products_variants
            LEFT JOIN color ON products_variants.color_id = color.id
            LEFT JOIN size ON products_variants.size_id = size.id
            WHERE products_variants.product_id = :id;
            ";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function isDuplicateVarriant($product_id, $sku, $color_id, $size_id)
    {
        $query = "SELECT id FROM products_variants 
                WHERE product_id = :product_id 
                AND sku = :sku
                AND color_id = :color_id 
                AND size_id = :size_id 
                LIMIT 1"; // Giới hạn 1 kết quả để tối ưu hiệu suất

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
        $stmt->bindParam(':sku', $sku, PDO::PARAM_STR);
        $stmt->bindParam(':color_id', $color_id, PDO::PARAM_INT);
        $stmt->bindParam(':size_id', $size_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC) !== false; // Nếu có kết quả, tức là trùng
    }


    public function deleteProductVariant($id)
    {
        $query = "DELETE FROM products_variants WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
