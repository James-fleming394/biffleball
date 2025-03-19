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
        if ($stmt->execute([$userId, $teamId, $week])) {
            return true;
        } else {
            return "Database insert error: " . implode(" - ", $stmt->errorInfo());
        }
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

        // Only allow changes if it's before Monday (week start)
        if (date('N') > 1) { // 1 = Monday
            return false; // Cannot change pick after the week starts
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
