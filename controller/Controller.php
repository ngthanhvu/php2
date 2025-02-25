<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use App\Models\CartsModel;
use App\Models\OrderModel;
use App\Models\ProductModel;
use App\Models\ProductsVarriantModel;
use App\Models\UserModel;
use App\Models\AddressModel;
use App\Models\RatingModel;
use App\Core\BladeServiceProvider;

class Controller
{
    private $productModel;
    private $categoryModel;
    private $productsVarriantModel;
    private $cartsModel;
    private $orderModel;
    private $addressModel;
    private $userModel;
    private $ratingModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->categoryModel = new CategoryModel();
        $this->productsVarriantModel = new ProductsVarriantModel();
        $this->cartsModel = new CartsModel();
        $this->orderModel = new OrderModel();
        $this->userModel = new UserModel();
        $this->addressModel = new AddressModel();
        $this->ratingModel = new RatingModel();
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

    public function product()
    {
        $title = "Sản phẩm";

        $limit = 6;
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $offset = ($page - 1) * $limit;

        $products = $this->productModel->getPaginatedProducts($limit, $offset);
        $totalProducts = $this->productModel->getTotalProducts();
        $totalPages = ceil($totalProducts / $limit);
        $categories = $this->categoryModel->getAllCategories();

        BladeServiceProvider::render('product', compact('products', 'categories', 'title', 'totalPages', 'page'));
    }

    public function detail($id)
    {
        $title = "Chi tiết sản phẩm";
        $product = $this->productModel->getProductById($id);

        $category_id = $product['categories_id'];

        $products_varriants = $this->productsVarriantModel->getAllProductVariantsById($id);
        $related_products = $this->productModel->RelatedProducts($category_id);

        $ratings = $this->ratingModel->getRatingsByProduct($id);
        $averageRating = $this->ratingModel->getAverageRating($id);
        BladeServiceProvider::render('detail', compact('product', 'products_varriants', 'ratings', 'averageRating', 'related_products', 'title'));
    }

    public function rate($productId)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_SESSION['user']['id'])) {
                $_SESSION['cart_message'] = "Vui lòng đăng nhập để đánh giá sản phẩm!";
                header("Location: /detail/$productId");
                exit;
            }

            $userId = $_SESSION['user']['id'];
            $rating = $_POST['rating'];
            $comment = $_POST['comment'] ?? null;

            if ($rating >= 1 && $rating <= 5) {
                $this->ratingModel->addRating($productId, $userId, $rating, $comment);
                header("Location: /detail/$productId");
                exit;
            } else {
                $_SESSION['cart_message'] = "Điểm đánh giá không hợp lệ!";
                header("Location: /detail/$productId");
                exit;
            }
        }
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
        $addresses = $this->addressModel->getAllAddress($user_id);
        $cart_session = session_id();

        $carts = $this->cartsModel->getAllCarts($user_id, $cart_session);
        BladeServiceProvider::render('checkout', compact('carts', 'addresses', 'title'));
    }

    public function profile()
    {
        $title = "Thống tin cá nhân";
        $user_id = $_SESSION['user']['id'];
        $orders = $this->orderModel->getOrderByUserId($user_id);
        $users = $this->userModel->getUserById($user_id);
        $addresses = $this->addressModel->getAllAddress($user_id);
        BladeServiceProvider::render('profile.profile', compact('orders', 'users', 'addresses', 'title'));
    }

    public function tracking()
    {
        $title = "Theo dõi đơn hàng";
        BladeServiceProvider::render('tracking', compact('title'));
    }
}
