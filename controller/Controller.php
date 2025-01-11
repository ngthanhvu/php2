<?php
require_once "view/helpers.php";
require_once "model/PostModel.php";
class Controller
{
    public function index()
    {
        $postController = new PostController();
        $postController->showHome();
    }
}
