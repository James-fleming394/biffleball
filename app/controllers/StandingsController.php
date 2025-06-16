<?php
require_once __DIR__ . '/../models/Standings.php';

class StandingsController {
    public static function index() {
    $users = Standings::getAll(); // get total wins and current team for standings
    include __DIR__ . '/../views/standings.php';
}

    // Optional: expose getAll for other purposes if needed in controllers
    public static function getAll() {
        return Standings::getAll(); // this method must exist in the Standings model
    }
}
