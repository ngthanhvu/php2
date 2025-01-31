<?php
error_reporting(E_ALL & ~E_DEPRECATED);
require_once "controller/Controller.php";
require_once "controller/PostController.php";
require_once "controller/AuthController.php";
require_once "controller/ProductController.php";
require_once "controller/CategoryController.php";
require_once "controller/VnpayController.php";

require_once "router/Router.php";
require_once "middleware.php";

$router = new Router();
$PostController = new PostController();
$Controller = new Controller();
$AuthController = new AuthController();
$ProductController = new ProductController();
$CategoryController = new CategoryController();
$VnpayController = new VnPayController();

$router->addMiddleware('logRequest');

$router->addRoute("/", [$Controller, "index"]);
$router->addRoute("/admin", [$Controller, "admin"], ['isAdmin']);

// Posts
$router->addRoute("/admin/posts", [$PostController, "index"], ['isAdmin']);
$router->addRoute("/admin/posts/show/{id}", [$PostController, "show"]);
$router->addRoute("/admin/posts/create", [$PostController, "create"], ['isAdmin']);
$router->addRoute("/admin/posts/update/{id}", [$PostController, "update"], ['isAdmin']);
$router->addRoute("/admin/posts/delete/{id}", [$PostController, "delete"], ['isAdmin']);

// Products
$router->addRoute("/admin/products", [$ProductController, "index"], ['isAdmin']);
$router->addRoute("/admin/products/show/{id}", [$ProductController, "show"]);
$router->addRoute("/admin/products/create", [$ProductController, "create"], ['isAdmin']);
$router->addRoute("/admin/products/update/{id}", [$ProductController, "update"], ['isAdmin']);
$router->addRoute("/admin/products/delete/{id}", [$ProductController, "delete"], ['isAdmin']);

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
$router->addRoute("/payment", [$Controller, "payment"]);
$router->addRoute("/payment/create", [$VnpayController, "createPayment"]);
$router->addRoute("/payment/callback", [$VnpayController, "vnpayReturn"]);


//index product
$router->addRoute("/product", [$Controller, "product"]);
$router->addRoute("/detail/{id}", [$Controller, "detail"]);

//alert
$router->addRoute("/payment/success", [$Controller, "success"]);

$router->dispatch();
