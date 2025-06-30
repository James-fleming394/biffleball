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

        // Weekly Pick Distribution logic
        $availableWeeks = Analytics::getWeeksWithPicks(); // Returns array of weeks with picks

        // Use selected week from dropdown or default to most recent week
        $selectedWeek = $_GET['week_distribution'] ?? max($availableWeeks ?? [1]);

        $distributionData = Analytics::getWeeklyPickDistribution($selectedWeek);

        include __DIR__ . '/../views/analytics.php';
    }
}
