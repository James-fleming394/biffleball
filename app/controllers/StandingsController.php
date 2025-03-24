<?php
require_once __DIR__ . '/../models/Standings.php';

class StandingsController {
    public static function index() {
        $users = Standings::getAllUsersWithCurrentTeam();
        include __DIR__ . '/../views/standings.php';
    }
}
