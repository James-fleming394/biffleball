<?php
require_once 'app/controllers/UserController.php';
require_once 'app/controllers/StandingsController.php';
require_once 'app/controllers/PickController.php';
require_once 'app/controllers/APIController.php';

session_start();

$page = $_GET['page'] ?? 'home';

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
        if (!isset($_SESSION['user_id'])) {
            header("Location: /index.php?page=login");
            exit();
        }
        UserController::profile();
        break;
    case 'standings':
        StandingsController::show();
        break;
    case 'pick-team':
        if (!isset($_SESSION['user_id'])) {
            header("Location: /index.php?page=login");
            exit();
        }
        PickController::showPicks();
        break;
    case 'update-wins':
        ApiController::updateTeamWins();
        break;
    default:
        include 'app/views/home.php';
        break;
}
?>
