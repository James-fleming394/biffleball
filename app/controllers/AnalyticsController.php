<?php
require_once __DIR__ . '/../models/Team.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Pick.php';
require_once __DIR__ . '/../models/Analytics.php';

class AnalyticsController {
    public static function index() {
        // WAA section data
        $waaStats = Analytics::getWAAStats();
        $teams = $waaStats['teams'];
        $sotuStats = Analytics::getSOTUStats();

        // Weekly Pick Distribution data
        $weekDistribution = $_GET['week_distribution'] ?? null;
        $distributionData = null;
        if ($weekDistribution) {
            $distributionData = Analytics::getWeeklyPickDistribution($weekDistribution);
        }

        include __DIR__ . '/../views/analytics.php';
    }
}
