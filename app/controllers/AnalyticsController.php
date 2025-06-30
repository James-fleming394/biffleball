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

        // Weekly Pick Distribution dropdown
        $weeksWithPicks = Analytics::getWeeksWithPicks();

        if (isset($_GET['week_distribution'])) {
            $selectedWeek = intval($_GET['week_distribution']);
        } elseif (!empty($weeksWithPicks)) {
            $selectedWeek = max($weeksWithPicks); // default to most recent week with picks
        } else {
            $selectedWeek = 1;
        }

    $distributionData = Analytics::getWeeklyPickDistribution($selectedWeek);

    include __DIR__ . '/../views/analytics.php';
}


    public static function getWeeklyDistributionAjax() {
        if (!isset($_GET['week'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Missing week']);
            return;
        }

        $week = intval($_GET['week']);
        $data = Analytics::getWeeklyPickDistribution($week);

        header('Content-Type: application/json');
        echo json_encode($data);
    }
}