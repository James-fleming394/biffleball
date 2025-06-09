<?php
require_once __DIR__ . '/../models/Team.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Pick.php';
require_once __DIR__ . '/../models/Analytics.php';

class AnalyticsController {
    public static function index() {
        $waaStats = Analytics::getWAAStats();

        // Unpack the WAA stats to match expected variable names in the view
        $teams = $waaStats['teams'];
        $users = $waaStats['users'];
        $leagueAverage = $waaStats['leagueAverage']; // changed from leagueAverages
        $usersWithTeamAvailable = $waaStats['usersWithTeamAvailable']; // changed from availability

        include __DIR__ . '/../views/analytics.php';
    }
}

