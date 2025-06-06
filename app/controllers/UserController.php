<?php
require_once __DIR__ . '/../models/User.php';
session_start();

class UserController {
    public static function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            if (User::create($username, $email, $password)) {
                header("Location: /index.php?page=login&success=1");
                exit();
            } else {
                echo "Registration failed.";
            }
        }
    }

    public static function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            if ($user = User::verifyPassword($email, $password)) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_email'] = $user['email'];
                header("Location: /index.php?page=profile");
                exit();
            } else {
                echo "Invalid credentials.";
            }
        }
    }

    public static function logout() {
        session_destroy();
        header("Location: /index.php?page=login");
        exit();
    }

    public static function profile() {
        if (!isset($_SESSION['user_email'])) {
            header("Location: /index.php?page=login");
            exit();
        }

        $user = User::findById($_SESSION['user_id']);
        include __DIR__ . '/../views/profile.php';
    }

    public static function uploadAvatar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['avatar']) && isset($_SESSION['user_id'])) {
            $userId = $_SESSION['user_id'];
            $uploadDir = __DIR__ . '/../uploads/avatars/';
            $filename = uniqid('avatar_') . '_' . basename($_FILES['avatar']['name']);
            $targetFile = $uploadDir . $filename;
            $webPath = 'uploads/avatars/' . $filename;

            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            if (move_uploaded_file($_FILES['avatar']['tmp_name'], $targetFile)) {
                User::updateAvatar($userId, $webPath);
                header("Location: /index.php?page=profile");
                exit();
            } else {
                echo "Avatar upload failed.";
            }
        }
    }
}

// Handle direct requests
if (isset($_GET['action'])) {
    if ($_GET['action'] === 'register') {
        UserController::register();
    } elseif ($_GET['action'] === 'login') {
        UserController::login();
    } elseif ($_GET['action'] === 'logout') {
        UserController::logout();
    } elseif ($_GET['action'] === 'upload_avatar') {
        UserController::uploadAvatar();
    }
}
?>