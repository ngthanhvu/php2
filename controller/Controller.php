<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use App\Models\CartsModel;
use App\Models\OrderModel;
use App\Models\ProductModel;
use App\Models\ProductsVarriantModel;
use App\Core\BladeServiceProvider;

class Controller
{
    private $productModel;
    private $categoryModel;
    private $productsVarriantModel;
    private $cartsModel;
    private $orderModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->categoryModel = new CategoryModel();
        $this->productsVarriantModel = new ProductsVarriantModel();
        $this->cartsModel = new CartsModel();
        $this->orderModel = new OrderModel();
    }
    public function index()
    {
        $title = "Trang chủ";
        $products = $this->productModel->getAllProducts();
        $categories = $this->categoryModel->getAllCategories();
        BladeServiceProvider::render('index', compact('products', 'categories', 'title'));
    }

    public function admin()
    {
        $title = "Bảng điều khiển";
        $products = $this->productModel->getAllProducts();
        $categories = $this->categoryModel->getAllCategories();
        BladeServiceProvider::render('admin.index', compact('products', 'categories', 'title'));
    }

    public function payment()
    {
        // renderView('view/payment.php', compact('payments'), 'Nạp thẻ');
    }

    public function product()
    {
        $title = "Sản phẩm";
        $categories = $this->categoryModel->getAllCategories();
        $products = $this->productModel->getAllProducts();
        BladeServiceProvider::render('product', compact('products', 'categories', 'title'));
    }

    public function detail($id)
    {
        $title = "Chi tiết sản phẩm";
        $product = $this->productModel->getProductById($id);
        $products_varriants = $this->productsVarriantModel->getAllProductVariantsById($id);
        BladeServiceProvider::render('detail', compact('product', 'products_varriants', 'title'));
    }

    public function success()
    {
        $title = "Thành công";
        BladeServiceProvider::render('success', compact('title'));
    }

    public function errors()
    {
        $title = "Thất bại";
        BladeServiceProvider::render('errors', compact('title'));
    }

    public function checkout()
    {
        $title = "Thanh toán";
        $user_id = $_SESSION['user']['id'] ?? null;
        $cart_session = session_id();

        $carts = $this->cartsModel->getAllCarts($user_id, $cart_session);
        BladeServiceProvider::render('checkout', compact('carts', 'title'));
    }

    public function profile()
    {
        $title = "Thống tin cá nhân";
        $user_id = $_SESSION['user']['id'];
        $orders = $this->orderModel->getOrderByUserId($user_id);
        BladeServiceProvider::render('profile', compact('orders', 'title'));
    }
}
