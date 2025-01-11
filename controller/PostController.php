<?php
require_once 'model/PostModel.php';
require_once 'view/helpers.php';

class PostController
{
    private $model;

    public function __construct()
    {
        $this->model = new PostModel();
    }

    public function index()
    {
        $posts = $this->model->getAllPosts();
        renderView('view/posts/index.php', compact('posts'), 'Posts');
    }

    public function showHome()
    {
        $posts = $this->model->getAllPosts();
        renderView('view/index.php', compact('posts'), 'Home');
    }

    public function show($id)
    {
        $post = $this->model->getPostById($id);
        renderView('view/posts/show.php', compact('post'), 'Post Detail');
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $content = $_POST['content'];

            $this->model->createPost($title, $content);
            header('Location: /posts');
        } else {
            renderView('view/posts/create.php', [], 'Create Post');
        }
    }

    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $content = $_POST['content'];

            $this->model->updatePost($id, $title, $content);
            header('Location: /posts');
        } else {
            $post = $this->model->getPostById($id);
            renderView('view/posts/edit.php', compact('post'), 'Update Post');
        }
    }

    public function delete($id)
    {
        $this->model->deletePost($id);
        header('Location: /posts');
    }
}
