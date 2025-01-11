<?php
require_once "controller/Controller.php";
require_once "controller/PostController.php";
require_once "controller/AuthController.php";
require_once "router/Router.php";
require_once "middleware.php";

$router = new Router();
$PostController = new PostController();
$Controller = new Controller();
$AuthController = new AuthController();

$router->addMiddleware('logRequest');

$router->addRoute("/", [$Controller, "index"]);

// Posts
$router->addRoute("/posts", [$PostController, "index"], ['isUser']);
$router->addRoute("/posts/show/{id}", [$PostController, "show"]);
$router->addRoute("/posts/create", [$PostController, "create"]);
$router->addRoute("/posts/update/{id}", [$PostController, "update"]);
$router->addRoute("/posts/delete/{id}", [$PostController, "delete"]);

// Auth
$router->addRoute("/login", [$AuthController, "login"]);
$router->addRoute("/register", [$AuthController, "register"]);
$router->addRoute("/logout", [$AuthController, "logout"]);

$router->dispatch();
