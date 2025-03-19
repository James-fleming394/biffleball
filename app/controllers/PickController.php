<?php
require_once __DIR__ . '/../models/Pick.php';
require_once __DIR__ . '/../models/Team.php';

class PickController {
    public static function makePick() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
            $userId = $_SESSION['user_id'];
            $teamId = $_POST['team_id'];
            $week = date('W'); // Get current week of the year

            // Check if user already made a pick this week
            if (Pick::hasPickedThisWeek($userId, $week)) {
                header("Location: /index.php?page=picks&error=already_picked");
                exit();
            }

            // Attempt to save the pick
            if (Pick::makePick($userId, $teamId, $week)) {
                header("Location: /index.php?page=profile&pick_success=1");
                exit();
            } else {
                header("Location: /index.php?page=picks&error=pick_failed");
                exit();
            }
        }
    }

    public static function showPicks() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    
        if (!isset($_SESSION['user_id'])) {
            header("Location: /index.php?page=login");
            exit();
        }
    
        $userId = $_SESSION['user_id'];
        $teams = Team::getAll();
        $currentPick = Pick::getCurrentWeekPick($userId);
        $upcomingPick = Pick::getUpcomingWeekPick($userId);
    
        include __DIR__ . '/../views/pick.php';
    }
    
    public static function changePick() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
            $userId = $_SESSION['user_id'];
            $newTeamId = $_POST['new_team_id'];
            $week = date('W'); // Current week
    
            // Allow change if within the deadline
            if (Pick::changePick($userId, $newTeamId, $week)) {
                header("Location: /index.php?page=profile&pick_updated=1");
                exit();
            } else {
                header("Location: /index.php?page=picks&error=cannot_change_pick");
                exit();
            }
        }
    }
}    

// Handle direct requests
if (isset($_GET['action']) && $_GET['action'] === 'make-pick') {
    PickController::makePick();
} elseif (isset($_GET['page']) && $_GET['page'] === 'picks') {
    PickController::showPicks();
}
?>
