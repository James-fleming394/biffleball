<?php
require_once __DIR__ . '/../models/Analytics.php';

class AnalyticsController {
    public static function index() {
        $sotuStats = Analytics::getSOTUByUser();
        include __DIR__ . '/../views/analytics.php';
    }
}