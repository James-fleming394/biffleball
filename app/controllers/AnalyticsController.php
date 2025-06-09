<?php
require_once __DIR__ . '/../models/Team.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Pick.php';
require_once __DIR__ . '/../models/Analytics.php';

class AnalyticsController {
    public static function index() {
        $waaStats = Analytics::getWAAStats();
        $teams = $waaStats['teams'];
        $users = $waaStats['users'];
        $leagueAverages = $waaStats['leagueAverages'];
        $availability = $waaStats['availability'];

        include __DIR__ . '/../views/analytics.php';
    }
}
