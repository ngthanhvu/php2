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

// Posts
$router->addRoute("/posts", [$PostController, "index"], ['isUser']);
$router->addRoute("/posts/show/{id}", [$PostController, "show"]);
$router->addRoute("/posts/create", [$PostController, "create"], ['isUser']);
$router->addRoute("/posts/update/{id}", [$PostController, "update"], ['isUser']);
$router->addRoute("/posts/delete/{id}", [$PostController, "delete"], ['isUser']);

// Products
$router->addRoute("/products", [$ProductController, "index"], ['isUser']);
$router->addRoute("/products/show/{id}", [$ProductController, "show"]);
$router->addRoute("/products/create", [$ProductController, "create"], ['isUser']);
$router->addRoute("/products/update/{id}", [$ProductController, "update"], ['isUser']);
$router->addRoute("/products/delete/{id}", [$ProductController, "delete"], ['isUser']);

// Categories
$router->addRoute("/categories", [$CategoryController, "index"], ['isUser']);
$router->addRoute("/categories/create", [$CategoryController, "create"], ['isUser']);
$router->addRoute("/categories/update/{id}", [$CategoryController, "update"], ['isUser']);
$router->addRoute("/categories/delete/{id}", [$CategoryController, "delete"], ['isUser']);

// Auth
$router->addRoute("/login", [$AuthController, "login"]);
$router->addRoute("/register", [$AuthController, "register"]);
$router->addRoute("/logout", [$AuthController, "logout"]);
$router->addRoute("/forgotpassword", [$AuthController, "forgotPassword"]);
$router->addRoute("/resetpassword", [$AuthController, "resetPassword"]);

//Auth with social
$router->addRoute("/auth/facebook", [$AuthController, "loginWithFacebook"]);
$router->addRoute("/auth/google", [$AuthController, "loginWithGoogle"]);

$router->dispatch();
