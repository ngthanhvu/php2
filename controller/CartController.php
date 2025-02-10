<?php
require_once "model/CartsModel.php";
require_once "view/helpers.php";

class CartController
{
    private $cartsModel;

    public function __construct()
    {
        $this->cartsModel = new CartsModel();
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
        $this->cartsModel->addCart($user_id, $cart_session, $sku, $quantity, $price);
    }
}
