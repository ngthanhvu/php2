<?php
require_once "model/UserModel.php";
require_once "view/helpers.php";

class AuthController
{
    private $UserModel;

    public function __construct()
    {
        $this->UserModel = new UserModel();
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $this->UserModel->register($username, $email, $password);
            header('Location: /login');
        } else {
            renderView('view/auth/register.php', [], 'Register');
        }
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = $this->UserModel->login($email, $password);
            if ($user) {
                $_SESSION['user'] = $user;
                header('Location: /posts');
            } else {
                echo "Login failed";
            }
        } else {
            renderView('view/auth/login.php', [], 'Login');
        }
    }

    public function logout()
    {
        session_destroy();
        header('Location: /login');
    }
}
