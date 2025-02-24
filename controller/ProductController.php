<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Models\SizeModel;
use App\Models\ColorModel;
use App\Core\BladeServiceProvider;

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
        $title = 'Sản phẩm';

        $limit = 6;
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $offset = ($page - 1) * $limit;

        $products = $this->ProductModel->getPaginatedProducts($limit, $offset);
        $totalProducts = $this->ProductModel->getTotalProducts();
        $totalPages = ceil($totalProducts / $limit);

        BladeServiceProvider::render('admin.products.index', compact('products', 'title', 'totalPages', 'page'));
    }

    public function search()
    {
        if (isset($_GET['keyword'])) {
            $keyword = $_GET['keyword'];
            $products = $this->ProductModel->searchProducts($keyword);
            echo json_encode($products);
        }
    }

    public function filter()
    {
        $category_id = isset($_GET['category_id']) ? $_GET['category_id'] : null;
        $min_price = isset($_GET['min_price']) ? $_GET['min_price'] : null;
        $max_price = isset($_GET['max_price']) ? $_GET['max_price'] : null;

        $products = $this->ProductModel->filterProducts($category_id, $min_price, $max_price);

        echo json_encode($products);
    }


    public function showHomeProduct()
    {
        $title = 'Trang chủ';
        $products = $this->ProductModel->getAllProducts();
        BladeServiceProvider::render('index', compact('products', 'title'));
    }

    public function show($id)
    {
        $title = 'Chi tiêt sản phẩm';
        $product = $this->ProductModel->getProductById($id);
        BladeServiceProvider::render('admin.products.show', compact('product', 'title'));
    }

    public function create()
    {
        $title = 'Thêm sản phẩm';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = [];
            $name = $_POST['name'];
            $price = $_POST['price'];
            $description = $_POST['description'];
            $quantity = $_POST['quantity'];
            $sku = $_POST['sku'];
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

            if (empty($sku)) {
                $errors['sku'] = 'SKU is required';
            }

            if (empty($categories_id)) {
                $errors['categories_id'] = 'Categories ID is required';
            }

            if (!empty($errors)) {
                $categories = $this->CategoryModel->getAllCategories();
                BladeServiceProvider::render('admin.products.create', compact('errors', 'categories', 'title'));
            } else {
                $product_id = $this->ProductModel->addProductWithImages($name, $price, $description, $imagePath, $quantity, $sku, $categories_id, $uploadedImages);

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
            BladeServiceProvider::render('admin.products.create', compact('categories', 'title'));
        }
    }

    public function update($id)
    {
        $title = 'Update Product';
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
            BladeServiceProvider::render('admin.products.edit', compact('product', 'title'));
        }
    }

    public function delete($id)
    {
        $this->ProductModel->deleteProduct($id);
        $_SESSION['message'] = "Product deleted successfully!";
        header('Location: /admin/products');
    }
}
