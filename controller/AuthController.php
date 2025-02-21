<?php

namespace App\Controllers;

ob_start();

use App\Models\UserModel;
use App\Models\MailModel;
use App\Core\BladeServiceProvider;

use Google\Service\Oauth2;
use Illuminate\Support\Facades\Blade;
use Google_Client;
use Exception;

class AuthController
{
    private $UserModel;
    private $googleClient;
    private $fb;
    private $mailer;

    public function __construct()
    {
        $this->UserModel = new UserModel();
        $this->mailer = new MailModel();

        // Cấu hình Google Client
        $this->googleClient = new Google_Client();
        $this->googleClient->setClientId($_ENV['GOOGLE_CLIENT_ID']);
        $this->googleClient->setClientSecret($_ENV['GOOGLE_CLIENT_SECRET']);
        $this->googleClient->setRedirectUri($_ENV['GOOGLE_REDIRECT_URL']);
        $this->googleClient->addScope('email');
        $this->googleClient->addScope('profile');

        // Cấu hình Facebook SDK
        $this->fb = new \Facebook\Facebook([
            'app_id' => $_ENV['FACEBOOK_APP_ID'],
            'app_secret' => $_ENV['FACEBOOK_APP_SECRET'],
            'default_graph_version' => 'v15.0',
        ]);
    }

    public function index()
    {
        $title = "Admin";
        $users = $this->UserModel->getAllUsers();
        // renderView('view/admin/users/index.php', compact('users'), 'Users', 'admin');
        BladeServiceProvider::render('admin.users.index', compact('users', 'title'));
    }

    public function register()
    {
        $title = "Đăng ký";
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = [];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];

            if (empty($username)) {
                $errors['username'] = 'Username is required';
            }

            if (empty($email)) {
                $errors['email'] = 'Email is required';
            } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Invalid email format';
            }

            if (empty($password)) {
                $errors['password'] = 'Password is required';
            } else if (strlen($password) < 6) {
                $errors['password'] = 'Password must be at least 6 characters';
            }

            if (empty($confirmPassword)) {
                $errors['confirm_password'] = 'Confirm password is required';
            } else if ($password !== $confirmPassword) {
                $errors['confirm_password'] = 'Password does not match';
            }

            if (!empty($errors)) {
                BladeServiceProvider::render('auth.register', compact('errors', 'title'));
                return;
            } else {
                $user = $this->UserModel->getUserByEmail($email);
                if ($user) {
                    $errors['email'] = 'Email already exists';
                    BladeServiceProvider::render('auth.register', compact('errors', 'title'));
                    return;
                } else {
                    $this->UserModel->register($username, $email, $password);
                    $this->mailer->send($email, 'Welcome to our website', 'Thank you for registering on our website!');
                    $_SESSION['message'] = 'Register successfully.';
                    header('Location: /login');
                }
            }
        } else {
            BladeServiceProvider::render('auth.register', compact('title'));
        }
    }

    public function login()
    {
        $title = "Đăng nhập";
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = [];
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            if (empty($email)) {
                $errors['email'] = 'Email is required';
            }

            if (empty($password)) {
                $errors['password'] = 'Password is required';
            }

            if (!empty($errors)) {
                BladeServiceProvider::render('auth.login', compact('errors', 'title'));
                return;
            } else {
                $user = $this->UserModel->login($email, $password);
                if ($user) {
                    $_SESSION['user'] = $user;
                    header('Location: /');
                } else {
                    $errors['login'] = 'Invalid email or password';
                    BladeServiceProvider::render('auth.login', compact('errors', 'title'));
                }
            }
        } else {
            BladeServiceProvider::render('auth.login', compact('title'));
        }
    }

    public function logout()
    {
        session_destroy();
        header('Location: /login');
    }

    public function resetPassword()
    {
        $title = "Quên mật khẩu";
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = [];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];
            $otp = $_POST['otp'];

            if ($password !== $confirmPassword) {
                $errors['confirm_password'] = 'Password does not match';
            }

            if (!empty($errors)) {
                BladeServiceProvider::render('auth.resetpassword', compact('errors', 'title'));
                return;
            }

            $user = $this->UserModel->verifyOtp($email, $otp);

            if ($user) {
                $this->UserModel->updatePassword($email, $password);
                $_SESSION['message'] = "Reset password successfully.";
                header('Location: /login');
                exit;
            } else {
                $_SESSION['message'] = "OTP không hợp lệ hoặc đã hết hạn.";
                BladeServiceProvider::render('auth.resetpassword', compact('title'));
            }
        } else {
            BladeServiceProvider::render('auth.resetpassword', compact('title'));
        }
    }


    public function forgotPassword()
    {
        $title = "Quên mật khẩu";
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $otp = rand(100000, 999999);

            $email = $_POST['email'] ?? '';
            $_SESSION['email_forgot'] = $email;
            $this->UserModel->setOtp($email, $otp);
            $this->mailer->send($email, 'OTP Verification', "Your OTP is: $otp");
            header('Location: /resetpassword');
        } else {
            // renderView('view/auth/forgotpassword.php', [], 'Forgot Password');
            BladeServiceProvider::render('auth.forgotpassword', compact('title'));
        }
    }

    public function loginWithGoogle()
    {
        if (!isset($_GET['code'])) {
            $loginUrl = $this->googleClient->createAuthUrl();
            header('Location: ' . $loginUrl);
            exit;
        }

        $token = $this->googleClient->fetchAccessTokenWithAuthCode($_GET['code']);
        if (!isset($token['access_token'])) {
            die('Lỗi đăng nhập Google!');
        }

        $this->googleClient->setAccessToken($token['access_token']);
        $googleService = new Oauth2($this->googleClient);
        $userInfo = $googleService->userinfo->get();

        $user = $this->UserModel->findOrCreateUser([
            'username' => $userInfo->name,
            'email' => $userInfo->email,
            'password' => null,
            'oauth_provider' => 'google',
            'oauth_id' => $userInfo->id,
        ]);

        $_SESSION['user'] = $user;
        header('Location: /');
    }

    public function loginWithFacebook()
    {
        $helper = $this->fb->getRedirectLoginHelper();
        $permissions = ['public_profile', 'email'];

        if (!isset($_GET['code'])) {
            $loginUrl = $helper->getLoginUrl($_ENV['FACEBOOK_REDIRECT_URL'], $permissions);
            ob_clean();
            header('Location: ' . $loginUrl);
            exit;
        }

        try {
            $accessToken = $helper->getAccessToken();
            if (!$accessToken) {
                throw new Exception('Không thể lấy Access Token từ Facebook!');
            }

            if ($helper->getError()) {
                $loginUrl = $helper->getLoginUrl($_ENV['FACEBOOK_REDIRECT_URL'], $permissions);
                ob_clean();
                header('Location: ' . $loginUrl);
                exit;
            }

            $response = $this->fb->get('/me?fields=id,name,email', $accessToken);
            $user = $response->getGraphUser();

            $userData = [
                'username' => $user['name'],
                'email' => $user['email'] ?? null,
                'password' => null,
                'oauth_provider' => 'facebook',
                'oauth_id' => $user['id'],
            ];

            $user = $this->UserModel->findOrCreateUser($userData);
            $_SESSION['user'] = $user;
            ob_clean();
            header('Location: /');
            exit;
        } catch (\Facebook\Exceptions\FacebookResponseException $e) {
            die('Lỗi từ Facebook API: ' . $e->getMessage());
        } catch (\Facebook\Exceptions\FacebookSDKException $e) {
            die('Lỗi từ Facebook SDK: ' . $e->getMessage());
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function updateProfile()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user_id = $_SESSION['user']['id'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            var_dump($phone, $address);

            $this->UserModel->updateProfile($user_id, $username, $phone, $email, $address);
            header('Location: /profile');
        } else {
        }
    }
}
