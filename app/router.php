<?php
require_once __DIR__ . '/controllers/UserController.php';
require_once __DIR__ . '/controllers/StandingsController.php';
require_once __DIR__ . '/controllers/PickController.php';
require_once __DIR__ . '/controllers/ApiController.php';
require_once __DIR__ . '/controllers/AnalyticsController.php';

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Get the requested page or default to 'home'
$page = $_GET['page'] ?? 'home';

// Routing logic
switch ($page) {
    case 'register':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            UserController::register();
        } else {
            include __DIR__ . '/views/register.php';
        }
        break;

    case 'login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            UserController::login();
        } else {
            include __DIR__ . '/views/login.php';
        }
        break;

    case 'logout':
        UserController::logout();
        break;

    case 'upload-avatar':
        if (!isset($_SESSION['user_id'])) {
            header("Location: /index.php?page=login");
            exit();
        }
        UserController::uploadAvatar();
        break;

    case 'profile':
        if (!isset($_SESSION['user_id'])) {
            header("Location: /index.php?page=login");
            exit();
        }
        $user = User::findById($_SESSION['user_id']);
        $picks = Pick::getUserPicks($_SESSION['user_id']);
        include __DIR__ . '/views/profile.php';
        break;

    case 'standings':
        StandingsController::index();
        break;
        

    case 'pick-team':
        if (!isset($_SESSION['user_id'])) {
            header("Location: /index.php?page=login");
            exit();
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            PickController::makePick();
        } else {
            PickController::showPicks();
        }
        break;

    case 'change-pick':
        if (!isset($_SESSION['user_id'])) {
            header("Location: /index.php?page=login");
            exit();
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            PickController::changePick();
        }
        break;

    case 'update-wins':
        ApiController::updateTeamWins();
        break;
    
    case 'home':
        HomeController::index();
        break;
    
    case 'analytics':
        AnalyticsController::index();
        break;
        
    default:
        include __DIR__ . '/views/home.php';
        break;
}
?>

