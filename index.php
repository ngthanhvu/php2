<?php
error_reporting(E_ALL & ~E_DEPRECATED);
require_once "controller/Controller.php";
require_once "controller/PostController.php";
require_once "controller/AuthController.php";
require_once "controller/ProductController.php";
require_once "controller/CategoryController.php";

require_once "router/Router.php";
require_once "middleware.php";

$router = new Router();
$PostController = new PostController();
$Controller = new Controller();
$AuthController = new AuthController();
$ProductController = new ProductController();
$CategoryController = new CategoryController();

$router->addMiddleware('logRequest');

$router->addRoute("/", [$Controller, "index"]);
$router->addRoute("/admin", [$Controller, "admin"]);

// Posts
$router->addRoute("/admin/posts", [$PostController, "index"], ['isUser']);
$router->addRoute("/admin/posts/show/{id}", [$PostController, "show"]);
$router->addRoute("/admin/posts/create", [$PostController, "create"], ['isUser']);
$router->addRoute("/admin/posts/update/{id}", [$PostController, "update"], ['isUser']);
$router->addRoute("/admin/posts/delete/{id}", [$PostController, "delete"], ['isUser']);

// Products
$router->addRoute("/admin/products", [$ProductController, "index"], ['isUser']);
$router->addRoute("/admin/products/show/{id}", [$ProductController, "show"]);
$router->addRoute("/admin/products/create", [$ProductController, "create"], ['isUser']);
$router->addRoute("/admin/products/update/{id}", [$ProductController, "update"], ['isUser']);
$router->addRoute("/admin/products/delete/{id}", [$ProductController, "delete"], ['isUser']);

// Categories
$router->addRoute("/admin/categories", [$CategoryController, "index"], ['isUser']);
$router->addRoute("/admin/categories/create", [$CategoryController, "create"], ['isUser']);
$router->addRoute("/admin/categories/update/{id}", [$CategoryController, "update"], ['isUser']);
$router->addRoute("/admin/categories/delete/{id}", [$CategoryController, "delete"], ['isUser']);

// Auth
$router->addRoute("/login", [$AuthController, "login"]);
$router->addRoute("/register", [$AuthController, "register"]);
$router->addRoute("/logout", [$AuthController, "logout"]);
$router->addRoute("/forgotpassword", [$AuthController, "forgotPassword"]);
$router->addRoute("/resetpassword", [$AuthController, "resetPassword"]);

// Users
$router->addRoute("/admin/users", [$AuthController, "index"], ['isUser']);

//Auth with social
$router->addRoute("/auth/facebook", [$AuthController, "loginWithFacebook"]);
$router->addRoute("/auth/google", [$AuthController, "loginWithGoogle"]);

//payment
$router->addRoute("/payment", [$Controller, "payment"]);

//index product
$router->addRoute("/product", [$Controller, "product"]);
$router->addRoute("/detail", [$Controller, "detail"]);

$router->dispatch();
