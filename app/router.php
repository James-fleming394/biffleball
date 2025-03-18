<?php
require_once __DIR__ . '/controllers/UserController.php';
require_once __DIR__ . '/controllers/StandingsController.php';
require_once __DIR__ . '/controllers/PickController.php';
session_start();

// Get the requested page
$page = $_GET['page'] ?? 'home';

// Routing system
switch ($page) {
    case 'register':
        UserController::register();
        break;
    case 'login':
        UserController::login();
        break;
    case 'logout':
        UserController::logout();
        break;
    case 'profile':
        if (!isset($_SESSION['user_email'])) {
            header("Location: /index.php?page=login");
            exit();
        }
        UserController::profile();
        break;
    case 'standings':
        StandingsController::show();
        break;
    case 'pick-team':
        if (!isset($_SESSION['user_email'])) {
            header("Location: /index.php?page=login");
            exit();
        }
        PickController::makePick();
        break;
    default:
        include __DIR__ . '/views/home.php';
        break;
}
?>
