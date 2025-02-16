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
        echo "<pre>";
        var_dump($_POST);
        echo "</pre>";

        $user_id = $_SESSION['user']['id'] ?? null;
        $cart_session = session_id();
        $sku = $_POST['sku'];
        $quantity = (int)$_POST['quantity'];
        $price = $_POST['price'];
        $product_id = $_POST['product_id'];
        $variant_id = $_POST['variant_id'] ?? null;

        if ($variant_id) {
            $checkQuantity = $this->productsVariantsModel->getQuanityProductVarriantBySku($sku);
        } else {
            $checkQuantity = $this->productsModel->getQuanityProductBySku($sku);
        }

        $stockQuantity = (int)$checkQuantity;
        if ($stockQuantity < (int)$quantity) {
            $_SESSION['cart_message'] = 'Số lượng sản phẩm không đủ';
            header('Location: /detail/' . $product_id);
            return;
        }
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
