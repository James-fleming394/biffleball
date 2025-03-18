<?php
require_once __DIR__ . '/../models/Standings.php';

class StandingsController {
    public static function show() {
        $rankings = Standings::getRankings();
        include __DIR__ . '/../views/standings.php';
    }
}

// Handle direct requests
if (isset($_GET['action']) && $_GET['action'] === 'view') {
    StandingsController::show();
}
?>
