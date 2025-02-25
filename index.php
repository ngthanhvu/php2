<?php
error_reporting(E_ALL & ~E_DEPRECATED);

require_once __DIR__ . "/vendor/autoload.php";
require_once "middleware.php";

use App\Controllers\Controller;
use App\Controllers\CartController;
use App\Controllers\AuthController;
use App\Controllers\ProductController;
use App\Controllers\CategoryController;
use App\Controllers\VnPayController;
use App\Controllers\VarriantController;
use App\Controllers\ProductsVarriantController;
use App\Controllers\OrderController;
use App\Controllers\MomoController;
use App\Controllers\AddressController;
use App\Routers\Router;

$router = new Router();
$Controller = new Controller();
$CartController = new CartController();
$AuthController = new AuthController();
$ProductController = new ProductController();
$CategoryController = new CategoryController();
$VnpayController = new VnPayController();
$VarriantController = new VarriantController();
$ProductsVarriantController = new ProductsVarriantController();
$OrderController = new OrderController();
$MomoController = new MomoController();
$AddressController = new AddressController();

$router->addMiddleware('logRequest');

$router->addRoute("/", [$Controller, "index"]);
$router->addRoute("/admin", [$Controller, "admin"], ['isAdmin']);

// Products
$router->addRoute("/admin/products", [$ProductController, "index"], ['isAdmin']);
$router->addRoute("/admin/products/show/{id}", [$ProductController, "show"]);
$router->addRoute("/admin/products/create", [$ProductController, "create"], ['isAdmin']);
$router->addRoute("/admin/products/update/{id}", [$ProductController, "update"], ['isAdmin']);
$router->addRoute("/admin/products/delete/{id}", [$ProductController, "delete"], ['isAdmin']);
$router->addRoute("/admin/products/addProductVarrant/{id}", [$ProductsVarriantController, "addProductVarrant"], ['isAdmin']);
$router->addRoute("/admin/products/products-variants/{id}", [$ProductsVarriantController, "getAllProductVariants"], ['isAdmin']);
$router->addRoute("/admin/products/deleteProductVariant/{id}", [$ProductsVarriantController, "deleteProductVariant"], ['isAdmin']);
$router->addRoute("/product/search", [$ProductController, "search"]);
$router->addRoute("/product/filter", [$ProductController, "filter"]);

// Categories
$router->addRoute("/admin/categories", [$CategoryController, "index"], ['isAdmin']);
$router->addRoute("/admin/categories/create", [$CategoryController, "create"], ['isAdmin']);
$router->addRoute("/admin/categories/update/{id}", [$CategoryController, "update"], ['isAdmin']);
$router->addRoute("/admin/categories/delete/{id}", [$CategoryController, "delete"], ['isAdmin']);

// Auth
$router->addRoute("/login", [$AuthController, "login"]);
$router->addRoute("/register", [$AuthController, "register"]);
$router->addRoute("/logout", [$AuthController, "logout"]);
$router->addRoute("/forgotpassword", [$AuthController, "forgotPassword"]);
$router->addRoute("/resetpassword", [$AuthController, "resetPassword"]);

// Users
$router->addRoute("/admin/users", [$AuthController, "index"], ['isAdmin']);

//Auth with social
$router->addRoute("/auth/facebook", [$AuthController, "loginWithFacebook"]);
$router->addRoute("/auth/google", [$AuthController, "loginWithGoogle"]);

//payment
$router->addRoute("/payment/create", [$VnpayController, "createPayment"]);
$router->addRoute("/payment/callback", [$VnpayController, "vnpayReturn"]);
$router->addRoute("/payment/momo/create", [$MomoController, "createPayment"]);
$router->addRoute("/payment/momo/callback", [$MomoController, "momoCallback"]);

//index product
$router->addRoute("/product", [$Controller, "product"]);
$router->addRoute("/detail/{id}", [$Controller, "detail"]);

//alert
$router->addRoute("/payment/success", [$Controller, "success"]);
$router->addRoute("/payment/errors", [$Controller, "errors"]);

//cart
$router->addRoute("/cart", [$CartController, "getCart"]);
$router->addRoute("/cart/create", [$CartController, "addCart"]);
$router->addRoute("/cart/delete/{id}", [$CartController, "deleteCart"]);
$router->addRoute("/cart/deleteAll", [$CartController, "deleteAllCart"]);
$router->addRoute("/cart/updateQuantity/{id}/{quantity}", [$CartController, "updateQuantityCart"]);

//color
$router->addRoute("/admin/colors", [$VarriantController, "indexColor"], ['isAdmin']);
$router->addRoute("/admin/colors/create", [$VarriantController, "createColor"], ['isAdmin']);
$router->addRoute("/admin/colors/update/{id}", [$VarriantController, "updateColor"], ['isAdmin']);
$router->addRoute("/admin/colors/delete/{id}", [$VarriantController, "deleteColor"], ['isAdmin']);

//size
$router->addRoute("/admin/sizes", [$VarriantController, "indexSize"], ['isAdmin']);
$router->addRoute("/admin/sizes/create", [$VarriantController, "createSize"], ['isAdmin']);
$router->addRoute("/admin/sizes/update/{id}", [$VarriantController, "updateSize"], ['isAdmin']);
$router->addRoute("/admin/sizes/delete/{id}", [$VarriantController, "deleteSize"], ['isAdmin']);

//orders admin
$router->addRoute("/admin/orders", [$OrderController, "index"], ['isAdmin']);
$router->addRoute("/admin/orders/update", [$OrderController, "updateStatus"], ['isAdmin']);
$router->addRoute("/admin/orders/delete/{id}", [$OrderController, "deleteOrder"], ['isAdmin']);

//checkout
$router->addRoute("/checkout", [$Controller, "checkout"], ['isUser']);
$router->addRoute("/checkout/create", [$OrderController, "createOrder"], ['isUser']);

//success
$router->addRoute("/success", [$Controller, "success"]);

//profile
$router->addRoute("/profile", [$Controller, "profile"], ['isUser']);
$router->addRoute("/profile/update", [$AuthController, "updateProfile"], ['isUser']);
$router->addRoute("/profile/address/add", [$AddressController, "createAddress"], ['isUser']);
$router->addRoute("/profile/address/update/{id}", [$AddressController, "updateAddress"], ['isUser']);

//tracking
$router->addRoute("/tracking", [$Controller, "tracking"]);
$router->addRoute("/tracking/get/{id}", [$OrderController, "getOrdersById"]);

//rating
$router->addRoute("/products/rate/{id}", [$Controller, "rate"]);

$router->dispatch();
