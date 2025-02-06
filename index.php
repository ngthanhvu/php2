<?php
error_reporting(E_ALL & ~E_DEPRECATED);
require_once "controller/Controller.php";
require_once "controller/AuthController.php";
require_once "controller/ProductController.php";
require_once "controller/CategoryController.php";
require_once "controller/VnpayController.php";
require_once "controller/VarriantController.php";

require_once "router/Router.php";
require_once "middleware.php";

$router = new Router();
$Controller = new Controller();
$AuthController = new AuthController();
$ProductController = new ProductController();
$CategoryController = new CategoryController();
$VnpayController = new VnPayController();
$VarriantController = new VarriantController();

$router->addMiddleware('logRequest');

$router->addRoute("/", [$Controller, "index"]);
$router->addRoute("/admin", [$Controller, "admin"], ['isAdmin']);

// Products
$router->addRoute("/admin/products", [$ProductController, "index"], ['isAdmin']);
$router->addRoute("/admin/products/show/{id}", [$ProductController, "show"]);
$router->addRoute("/admin/products/create", [$ProductController, "create"], ['isAdmin']);
$router->addRoute("/admin/products/update/{id}", [$ProductController, "update"], ['isAdmin']);
$router->addRoute("/admin/products/delete/{id}", [$ProductController, "delete"], ['isAdmin']);
$router->addRoute("/admin/products/addProductVarrant/{id}", [$ProductController, "addProductVarrant"], ['isAdmin']);
$router->addRoute("/admin/products/products-variants/{id}", [$ProductController, "getAllProductVariants"], ['isAdmin']);
$router->addRoute("/admin/products/deleteProductVariant/{id}", [$ProductController, "deleteProductVariant"], ['isAdmin']);

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


//index product
$router->addRoute("/product", [$Controller, "product"]);
$router->addRoute("/detail/{id}", [$Controller, "detail"]);

//alert
$router->addRoute("/payment/success", [$Controller, "success"]);
$router->addRoute("/payment/errors", [$Controller, "errors"]);

//cart
$router->addRoute("/cart", [$Controller, "cart"]);

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

$router->dispatch();
