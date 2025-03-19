<?php
require_once __DIR__ . '/../config.php'; // Load database connection

class Pick {
    public static function makePick($userId, $teamId, $week) {
        global $pdo; // Use PDO from config.php

        // Check if user has already made a pick this week
        $stmt = $pdo->prepare("SELECT * FROM picks WHERE user_id = ? AND week = ?");
        $stmt->execute([$userId, $week]);

        if ($stmt->rowCount() > 0) {
            return "You have already made a pick this week.";
        }

        // Insert the pick into the database
        $stmt = $pdo->prepare("INSERT INTO picks (user_id, team_id, week) VALUES (?, ?, ?)");
        return $stmt->execute([$userId, $teamId, $week]);
    }

    public static function getUserPicks($userId) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT picks.*, teams.name AS team_name 
                               FROM picks 
                               JOIN teams ON picks.team_id = teams.id 
                               WHERE picks.user_id = ? 
                               ORDER BY picks.week DESC");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getCurrentWeekPick($userId) {
        global $pdo;
        $week = date('W'); // Get current week

        $stmt = $pdo->prepare("SELECT picks.*, teams.name AS team_name FROM picks 
                               JOIN teams ON picks.team_id = teams.id 
                               WHERE picks.user_id = ? AND picks.week = ?");
        $stmt->execute([$userId, $week]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getUpcomingWeekPick($userId) {
        global $pdo;
        $week = date('W') + 1; // Next week

        $stmt = $pdo->prepare("SELECT picks.*, teams.name AS team_name FROM picks 
                               JOIN teams ON picks.team_id = teams.id 
                               WHERE picks.user_id = ? AND picks.week = ?");
        $stmt->execute([$userId, $week]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function changePick($userId, $newTeamId, $week) {
        global $pdo;

        // Get current day and time
        $currentDay = date('N'); // 1 (Monday) - 7 (Sunday)
        $currentTime = date('H'); // Hour in 24-hour format

        // Only allow changes before 9PM (21:00) on Sunday (day 7)
        if ($currentDay == 7 && $currentTime >= 21) { 
            return false; // Cannot change pick after 9PM Sunday
        }

        $stmt = $pdo->prepare("UPDATE picks SET team_id = ? WHERE user_id = ? AND week = ?");
        return $stmt->execute([$newTeamId, $userId, $week]);
    }

    public static function hasPickedThisWeek($userId, $week) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT id FROM picks WHERE user_id = ? AND week = ?");
        $stmt->execute([$userId, $week]);
        return $stmt->rowCount() > 0;
    }
}
?>
