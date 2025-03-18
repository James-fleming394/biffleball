<?php
require_once __DIR__ . '/../models/Pick.php';
require_once __DIR__ . '/../models/Team.php';
session_start();

class PickController {
    public static function makePick() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
            $userId = $_SESSION['user_id'];
            $teamId = $_POST['team_id'];
            $week = date('W'); // Get current week of the year

            $result = Pick::makePick($userId, $teamId, $week);

            if ($result === true) {
                header("Location: /index.php?page=profile&pick_success=1");
                exit();
            } else {
                echo $result;
            }
        }
    }

    public static function showPicks() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: /index.php?page=login");
            exit();
        }

        $picks = Pick::getUserPicks($_SESSION['user_id']);
        include __DIR__ . '/../views/pick.php';
    }
}

// Handle direct requests
if (isset($_GET['action']) && $_GET['action'] === 'make-pick') {
    PickController::makePick();
}
?>
