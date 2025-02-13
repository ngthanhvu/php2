<?php
require_once "model/CartsModel.php";
require_once "model/ProductModel.php";
require_once "model/ProductsVarriantModel.php";
require_once "view/helpers.php";

class CartController
{
    private $cartsModel;
    private $productsModel;
    private $productsVariantsModel;

    public function __construct()
    {
        $this->cartsModel = new CartsModel();
        $this->productsModel = new ProductModel();
        $this->productsVariantsModel = new ProductsVarriantModel();
    }

    public function getCart()
    {
        $user_id = $_SESSION['user']['id'] ?? null;
        $cart_session = session_id();
        $carts = $this->cartsModel->getAllCarts($user_id, $cart_session);
        renderView('view/cart.php', compact('carts'), 'Giỏ hàng');
    }

    public function addCart()
    {
        $user_id = $_SESSION['user']['id'] ?? null;
        $cart_session = session_id();
        $sku = $_POST['sku'];
        $quantity = $_POST['quantity'];
        $price = $_POST['price'];
        $product_id = $_POST['product_id'];

        $this->cartsModel->addCart($user_id, $cart_session, $sku, $quantity, $price);
        header('Location: /cart');
    }

    public function updateQuantityCart($id, $quantity)
    {
        if ($this->cartsModel->updateQuantityCart($id, $quantity)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false]);
        }
    }

    public function deleteCart($id)
    {
        $this->cartsModel->deleteCart($id);
        header('Location: /cart');
    }

    public function deleteAllCart()
    {
        $user_id = $_SESSION['user']['id'] ?? null;
        $cart_session = session_id();
        $this->cartsModel->deleteAllCart($user_id, $cart_session);
        header('Location: /cart');
    }
}
