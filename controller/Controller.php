<?php
require_once "view/helpers.php";
require_once "model/PostModel.php";
require_once "model/ProductModel.php";
require_once "model/CategoryModel.php";
require_once "model/WalletModel.php";

class Controller
{
    private $postModel;
    private $productModel;
    private $categoryModel;
    private $walletModel;

    public function __construct()
    {
        $this->postModel = new PostModel();
        $this->productModel = new ProductModel();
        $this->categoryModel = new CategoryModel();
        $this->walletModel = new WalletModel();
    }
    public function index()
    {
        $posts = $this->postModel->getAllPosts();
        $products = $this->productModel->getAllProducts();
        $categories = $this->categoryModel->getAllCategories();
        renderView('view/index.php', compact('posts', 'products', 'categories'), 'Trang chủ');
    }

    public function admin()
    {
        $posts = $this->postModel->getAllPosts();
        $products = $this->productModel->getAllProducts();
        $categories = $this->categoryModel->getAllCategories();
        renderView('view/admin/index.php', compact('posts', 'products', 'categories'), 'Dashboard', 'admin');
    }

    public function payment()
    {
        $payments = $this->walletModel->getWallet($_SESSION['user']['id']);
        renderView('view/payment.php', compact('payments'), 'Nạp thẻ');
    }

    public function product()
    {
        $categories = $this->categoryModel->getAllCategories();
        $products = $this->productModel->getAllProducts();
        renderView('view/product.php', compact('products', 'categories'), 'Sản phẩm');
    }

    public function detail($id)
    {
        $product = $this->productModel->getProductById($id);
        renderView('view/detail.php', compact('product'), 'Chi tiết sản phẩm');
    }

    public function success()
    {
        renderView('view/success.php', [], 'Thành công');
    }

    public function errors()
    {
        renderView('view/errors.php', [], 'Thất bại');
    }

    public function cart()
    {
        renderView('view/cart.php', [], 'Giỏ hàng');
    }
}
