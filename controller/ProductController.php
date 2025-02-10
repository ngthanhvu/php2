<?php
require_once "model/ProductModel.php";
require_once "model/CategoryModel.php";
require_once "model/SizeModel.php";
require_once "model/ColorModel.php";
require_once 'view/helpers.php';

class ProductController
{
    private $ProductModel;
    private $CategoryModel;
    private $SizeModel;
    private $ColorModel;

    public function __construct()
    {
        $this->ProductModel = new ProductModel();
        $this->CategoryModel = new CategoryModel();
        $this->SizeModel = new SizeModel();
        $this->ColorModel = new ColorModel();
    }

    public function index()
    {
        $products = $this->ProductModel->getAllProducts();
        renderView('view/admin/products/index.php', compact('products'), 'Products', 'admin');
    }

    public function showHomeProduct()
    {
        $products = $this->ProductModel->getAllProducts();
        renderView('view/index.php', compact('products'), 'Home');
    }

    public function show($id)
    {
        $product = $this->ProductModel->getProductById($id);
        renderView('view/products/show.php', compact('product'), 'Product Detail', 'admin');
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = [];
            $name = $_POST['name'];
            $price = $_POST['price'];
            $description = $_POST['description'];
            $quantity = $_POST['quantity'];
            $categories_id = $_POST['categories_id'];
            $uploadedImages = [];

            if (empty($name)) {
                $errors['name'] = 'Name is required';
            }

            if (empty($price)) {
                $errors['price'] = 'Price is required';
            }

            if (empty($description)) {
                $errors['description'] = 'Description is required';
            }

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

            // Upload nhiều ảnh phụ
            if (isset($_FILES['sub_images']) && !empty($_FILES['sub_images']['name'][0])) {
                $uploadDir = 'uploads/';
                $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];

                foreach ($_FILES['sub_images']['name'] as $key => $imageName) {
                    $imageTmpName = $_FILES['sub_images']['tmp_name'][$key];
                    $imageType = $_FILES['sub_images']['type'][$key];

                    if (in_array($imageType, $allowedTypes)) {
                        $newImageName = time() . "_" . basename($imageName);
                        $imagePath = $uploadDir . $newImageName;

                        if (move_uploaded_file($imageTmpName, $imagePath)) {
                            $uploadedImages[] = $imagePath;
                        }
                    }
                }
            }

            if (empty($quantity)) {
                $errors['quantity'] = 'Quantity is required';
            }

            if (empty($categories_id)) {
                $errors['categories_id'] = 'Categories ID is required';
            }

            if (!empty($errors)) {
                $categories = $this->CategoryModel->getAllCategories();
                renderView('view/admin/products/create.php', compact('errors', 'categories'), 'Create Product', 'admin');
            } else {
                $product_id = $this->ProductModel->addProductWithImages($name, $price, $description, $imagePath, $quantity, $categories_id, $uploadedImages);

                if ($product_id) {
                    $_SESSION['message'] = "Product created successfully!";
                    header('Location: /admin/products');
                    exit;
                } else {
                    $_SESSION['error'] = "Failed to create product!";
                }
            }
        } else {
            $categories = $this->CategoryModel->getAllCategories();
            renderView('view/admin/products/create.php', compact('categories'), 'Create Product', 'admin');
        }
    }

    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $price = $_POST['price'];
            $description = $_POST['description'];
            $image = $_POST['image'];
            $quantity = $_POST['quantity'];
            $categories_id = $_POST['categories_id'];

            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = 'uploads/';
                $imageName = basename($_FILES['image']['name']);
                $imagePath = $uploadDir . time() . "_" . $imageName; // Đổi tên tránh trùng lặp

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

            $this->ProductModel->updateProduct($id, $name, $price, $description, $imagePath, $quantity, $categories_id);
            $_SESSION['message'] = "Product updated successfully!";
            header('Location: /admin/products');
        } else {
            $product = $this->ProductModel->getProductById($id);
            renderView('view/admin/products/edit.php', compact('product'), 'Update Product', 'admin');
        }
    }

    public function delete($id)
    {
        $this->ProductModel->deleteProduct($id);
        $_SESSION['message'] = "Product deleted successfully!";
        header('Location: /admin/products');
    }
}
