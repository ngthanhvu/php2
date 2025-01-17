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
        renderView('view/admin/posts/index.php', compact('posts'), 'Posts', 'admin');
    }

    public function showHome()
    {
        $posts = $this->model->getAllPosts();
        renderView('view/index.php', compact('posts'), 'Home');
    }

    public function show($id)
    {
        $post = $this->model->getPostById($id);
        renderView('view/posts/show.php', compact('post'), 'Post Detail', 'admin');
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = [];
            $title = $_POST['title'];
            $content = $_POST['content'];

            if (empty($title)) {
                $errors['title'] = 'Title is required';
            }

            if (empty($content)) {
                $errors['content'] = 'Content is required';
            }

            if (!empty($errors)) {
                renderView('view/admin/posts/create.php', compact('errors'), 'Create Post', 'admin');
                return;
            } else {
                $this->model->createPost($title, $content);
                header('Location: /admin/posts');
            }
        } else {
            renderView('view/admin/posts/create.php', [], 'Create Post', 'admin');
        }
    }

    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $content = $_POST['content'];

            $this->model->updatePost($id, $title, $content);
            $_SESSION['message'] = "Post updated successfully!";
            header('Location: /admin/posts');
        } else {
            $post = $this->model->getPostById($id);
            renderView('view/admin/posts/edit.php', compact('post'), 'Update Post', 'admin');
        }
    }

    public function delete($id)
    {
        $this->model->deletePost($id);
        $_SESSION['message'] = "Post deleted successfully!";
        header('Location: /admin/posts');
    }
}
