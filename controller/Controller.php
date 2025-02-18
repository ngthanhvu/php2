<?php
require_once "view/helpers.php";
require_once "model/ProductModel.php";
require_once "model/CategoryModel.php";
require_once "model/ProductsVarriantModel.php";
require_once "model/OrderModel.php";
require_once "model/CartsModel.php";
require_once "model/OrderModel.php";
require_once 'core/BladeServiceProvider.php';

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
        //        renderView('view/detail.blade.php', compact('product', 'products_varriants'), 'Chi tiết sản phẩm');
    }

    public function success()
    {
        $title = "Thành công";
        BladeServiceProvider::render('success', compact('title'));
    }

    public function errors()
    {
        renderView('view/errors.php', [], 'Thất bại');
    }

    public function cart()
    {
        renderView('view/cart.php', [], 'Giỏ hàng');
    }

    public function checkout()
    {
        $user_id = $_SESSION['user']['id'] ?? null;
        $cart_session = session_id();

        $carts = $this->cartsModel->getAllCarts($user_id, $cart_session);
        renderView('view/checkout.php', compact('carts'), 'Thanh toán');
    }

    public function profile()
    {
        $user_id = $_SESSION['user']['id'];
        $orders = $this->orderModel->getOrderByUserId($user_id);
        renderView('view/profile/profile.php', compact('orders'), 'Thông tin cá nhân');
    }
}
