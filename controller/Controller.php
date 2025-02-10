<?php
require_once "view/helpers.php";
require_once "model/ProductModel.php";
require_once "model/CategoryModel.php";
require_once "model/ProductsVarriantModel.php";
class Controller
{
    private $productModel;
    private $categoryModel;
    private $productsVarriantModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->categoryModel = new CategoryModel();
        $this->productsVarriantModel = new ProductsVarriantModel();
    }
    public function index()
    {
        $products = $this->productModel->getAllProducts();
        $categories = $this->categoryModel->getAllCategories();
        renderView('view/index.php', compact('products', 'categories'), 'Trang chủ');
    }

    public function admin()
    {
        $products = $this->productModel->getAllProducts();
        $categories = $this->categoryModel->getAllCategories();
        renderView('view/admin/index.php', compact('products', 'categories'), 'Dashboard', 'admin');
    }

    public function payment()
    {
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
        $products_varriants = $this->productsVarriantModel->getAllProductVariantsById($id);
        renderView('view/detail.php', compact('product', 'products_varriants'), 'Chi tiết sản phẩm');
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
