<?php
require_once "model/ProductsVarriantModel.php";
require_once "model/SizeModel.php";
require_once "model/ColorModel.php";
require_once "model/ProductModel.php";
require_once 'view/helpers.php';


class ProductsVarriantController
{
    private $productsVarriantModel;
    private $SizeModel;
    private $ColorModel;
    private $ProductModel;

    public function __construct()
    {
        $this->productsVarriantModel = new ProductsVarriantModel();
        $this->SizeModel = new SizeModel();
        $this->ColorModel = new ColorModel();
        $this->ProductModel = new ProductModel();
    }

    public function addProductVarrant($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = [];
            $product_id = $_POST['product_id'];
            $price = $_POST['price'];
            $quantity = $_POST['quantity'];
            $sku = $_POST['sku'];
            $color_id = $_POST['color_id'];
            $size_id = $_POST['size_id'];

            // Kiểm tra trùng lặp
            if ($this->productsVarriantModel->checkExitsColorAndSize($color_id, $size_id)) {
                $errors['duplicate'] = "Sản phẩm với SKU, màu sắc và kích thước này đã tồn tại!";
                // Gửi lại form kèm theo lỗi và dừng tiến trình
                $product = $this->ProductModel->getProductById($id);
                $colors = $this->ColorModel->getAllColors();
                $sizes = $this->SizeModel->getAllSizes();
                renderView('view/admin/products/addProductVarrant.php', compact('errors', 'product', 'colors', 'sizes'), 'Add Product Variant', 'admin');
                exit();
            }

            // Các kiểm tra khác
            if (empty($product_id)) $errors['product_id'] = 'Product ID is required';
            if (empty($price)) $errors['price'] = 'Price is required';
            if (empty($quantity)) $errors['quantity'] = 'Quantity is required';
            if (empty($sku)) $errors['sku'] = 'SKU is required';
            if (empty($color_id)) $errors['color_id'] = 'Color ID is required';
            if (empty($size_id)) $errors['size_id'] = 'Size ID is required';

            // Xử lý ảnh nếu có upload
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = 'uploads/';
                $imageName = basename($_FILES['image']['name']);
                $imagePath = $uploadDir . time() . "_" . $imageName;

                $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                if (!in_array($_FILES['image']['type'], $allowedTypes)) {
                    $errors['image'] = 'Only JPG, PNG, and GIF files are allowed';
                } else {
                    if (!move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
                        $errors['image'] = 'Failed to upload image';
                    }
                }
            } else {
                $errors['image'] = 'Image is required';
            }

            // Nếu có lỗi thì dừng lại và hiển thị lại form
            if (!empty($errors)) {
                $product = $this->ProductModel->getProductById($id);
                $colors = $this->ColorModel->getAllColors();
                $sizes = $this->SizeModel->getAllSizes();
                renderView('view/admin/products/addProductVarrant.php', compact('errors', 'product', 'colors', 'sizes'), 'Add Product Variant', 'admin');
                exit();
            }

            // Thêm biến thể sản phẩm nếu không có lỗi
            $this->productsVarriantModel->createProductVariant($product_id, $price, $quantity, $sku, $imagePath, $color_id, $size_id);
            $_SESSION['message'] = "Product variant created successfully!";
            header('Location: /admin/products');
            exit();
        } else {
            $product = $this->ProductModel->getProductById($id);
            $colors = $this->ColorModel->getAllColors();
            $sizes = $this->SizeModel->getAllSizes();
            renderView('view/admin/products/addProductVarrant.php', compact('product', 'colors', 'sizes'), 'Add Product Variant', 'admin');
        }
    }

    public function getAllProductVariants()
    {
        $products = $this->productsVarriantModel->getAllProductVariants();
        $colors = $this->ColorModel->getAllColors();
        $sizes = $this->SizeModel->getAllSizes();
        renderView('view/admin/products/products_varriants/index.php', compact('products', 'colors', 'sizes'), 'Product Variants', 'admin');
    }

    public function deleteProductVariant($id)
    {
        $this->productsVarriantModel->deleteProductVariant($id);
        $_SESSION['message'] = "Product variant deleted successfully!";
        header('Location: /admin/products');
    }
}
