<?php
require_once "model/ProductModel.php";
require_once 'view/helpers.php';

class ProductController
{
    private $ProductModel;

    public function __construct()
    {
        $this->ProductModel = new ProductModel();
    }

    public function index()
    {
        $products = $this->ProductModel->getAllProducts();
        renderView('view/products/index.php', compact('products'), 'Products');
    }

    public function showHomeProduct()
    {
        $products = $this->ProductModel->getAllProducts();
        renderView('view/index.php', compact('products'), 'Home');
    }

    public function show($id)
    {
        $product = $this->ProductModel->getProductById($id);
        renderView('view/products/show.php', compact('product'), 'Product Detail');
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = [];
            $name = $_POST['name'];
            $price = $_POST['price'];
            $description = $_POST['description'];
            $image = $_POST['image'];

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

            if (!empty($errors)) {
                renderView('view/products/create.php', compact('errors'), 'Create Product');
            } else {
                $this->ProductModel->addProduct($name, $price, $description, $image);
                header('Location: /products');
            }
        } else {
            renderView('view/products/create.php', [], 'Create Product');
        }
    }


    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $price = $_POST['price'];
            $description = $_POST['description'];
            $image = $_POST['image'];

            $this->ProductModel->updateProduct($id, $name, $price, $description, $image);
            header('Location: /products');
        } else {
            $product = $this->ProductModel->getProductById($id);
            renderView('view/products/edit.php', compact('product'), 'Update Product');
        }
    }

    public function delete($id)
    {
        $this->ProductModel->deleteProduct($id);
        header('Location: /products');
    }
}
