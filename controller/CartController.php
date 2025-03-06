<?php

namespace App\Controllers;

use App\Models\CartsModel;
use App\Models\ProductModel;
use App\Models\ProductsVarriantModel;
use App\Core\BladeServiceProvider;

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
        $title = "Giỏ hàng";
        $user_id = $_SESSION['user']['id'] ?? null;
        $cart_session = session_id();
        $carts = $this->cartsModel->getAllCarts($user_id, $cart_session);
        BladeServiceProvider::render('cart', compact('carts', 'title'));
    }

    // public function addCart()
    // {
    //     $user_id = $_SESSION['user']['id'] ?? null;
    //     $cart_session = session_id();
    //     $sku = $_POST['sku'];
    //     $quantity = (int)$_POST['quantity'];
    //     $price = $_POST['price'];
    //     $product_id = $_POST['product_id'];
    //     $variant_id = $_POST['variant_id'] ?? null;

    //     if ($variant_id) {
    //         $checkQuantity = $this->productsVariantsModel->getQuanityProductVarriantBySku($sku);
    //     } else {
    //         $checkQuantity = $this->productsModel->getQuanityProductBySku($sku);
    //     }

    //     $stockQuantity = (int)$checkQuantity;
    //     if ($stockQuantity < (int)$quantity) {
    //         $_SESSION['cart_message'] = 'Số lượng sản phẩm không đủ';
    //         header('Location: /detail/' . $product_id);
    //         return;
    //     }
    //     $this->cartsModel->addCart($user_id, $cart_session, $sku, $quantity, $price);
    //     header('Location: /cart');
    // }

    public function addCart()
    {
        $user_id = $_SESSION['user']['id'] ?? null;
        $cart_session = session_id();
        $sku = $_POST['sku'];
        $quantity = (int)$_POST['quantity'];
        $price = $_POST['price'];
        $product_id = $_POST['product_id'];
        $variant_id = $_POST['variant_id'] ?? null;

        // Kiểm tra số lượng tồn kho
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

        // Kiểm tra xem sản phẩm với SKU đã tồn tại trong giỏ hàng chưa
        $existingCart = $this->cartsModel->getCartBySku($user_id, $cart_session, $sku);

        if ($existingCart) {
            // Nếu sản phẩm đã tồn tại, cập nhật số lượng
            $newQuantity = $existingCart['quantity'] + $quantity;
            if ($stockQuantity < $newQuantity) {
                $_SESSION['cart_message'] = 'Số lượng sản phẩm không đủ để thêm vào giỏ hàng';
                header('Location: /detail/' . $product_id);
                return;
            }
            $this->cartsModel->updateCartQuantity($existingCart['id'], $newQuantity);
        } else {
            // Nếu sản phẩm chưa tồn tại, thêm mới
            $this->cartsModel->addCart($user_id, $cart_session, $sku, $quantity, $price);
        }

        header('Location: /cart');
    }


    public function updateQuantityCart($id, $quantity)
    {
        $updateCart = $this->cartsModel->updateQuantityCart($id, $quantity);
        if ($updateCart) {
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
