<?php
require_once __DIR__ . '/../models/Analytics.php';

class HomeController {
    public static function index() {
        $week = 25; // You can replace this with dynamic logic like (int)date('W') if needed
        $topPicks = Analytics::getTopPicksForWeek($week);
        include __DIR__ . '/../views/home.php';
    }
}