<?php
require_once "model/ProductModel.php";
require_once "model/CategoryModel.php";
require_once 'view/helpers.php';

class ProductController
{
    private $ProductModel;
    private $CategoryModel;

    public function __construct()
    {
        $this->ProductModel = new ProductModel();
        $this->CategoryModel = new CategoryModel();
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
            $image = $_POST['image'];
            $quantity = $_POST['quantity'];
            $categories_id = $_POST['categories_id'];

            if (empty($name)) {
                $errors['name'] = 'Name is required';
            }

            if (empty($price)) {
                $errors['price'] = 'Price is required';
            }

            if (empty($description)) {
                $errors['description'] = 'Description is required';
            }

            if (empty($image)) {
                $errors['image'] = 'Image is required';
            }

            if (empty($quantity)) {
                $errors['quantity'] = 'Quantity is required';
            }

            if (empty($categories_id)) {
                $errors['categories_id'] = 'Categories ID is required';
            }

            if (!empty($errors)) {
                renderView('view/admin/products/create.php', compact('errors'), 'Create Product', 'admin');
            } else {
                $this->ProductModel->addProduct($name, $price, $description, $image, $quantity, $categories_id);
                $_SESSION['message'] = "Product created successfully!";
                header('Location: /admin/products');
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

            $this->ProductModel->updateProduct($id, $name, $price, $description, $image, $quantity, $categories_id);
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

    public function addProductVarrant($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $product_id = $_POST['product_id'];
            $variant_name = $_POST['variant_name'];
            $price = $_POST['price'];
            $quantity = $_POST['quantity'];
            $description = $_POST['description'];
            $sku = $_POST['sku'];
            $image = $_POST['image'];

            $this->ProductModel->createProductVariant($product_id, $variant_name, $price, $quantity, $description, $sku, $image);
            $_SESSION['message'] = "Product variant created successfully!";
            header('Location: /admin/products');
        } else {
            $product = $this->ProductModel->getProductById($id);
            renderView('view/admin/products/addProductVarrant.php', compact('product'), 'Add Product Varrant', 'admin');
        }
    }
}
