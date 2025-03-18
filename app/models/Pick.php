<?php
require_once __DIR__ . '/../config.php';

class Pick {
    // Check if user has already picked a team this week
    public static function hasPickedThisWeek($userId, $week) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT id FROM picks WHERE user_id = ? AND week = ?");
        $stmt->execute([$userId, $week]);
        return $stmt->fetch() ? true : false;
    }

    // Check if user has already picked this team in the season
    public static function hasPickedTeam($userId, $teamId) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT id FROM picks WHERE user_id = ? AND team_id = ?");
        $stmt->execute([$userId, $teamId]);
        return $stmt->fetch() ? true : false;
    }

    // Store a new pick (only if valid)
    public static function makePick($userId, $teamId, $week) {
        global $pdo;

        // Ensure pick is valid
        if (self::hasPickedThisWeek($userId, $week)) {
            return "You have already made a pick this week.";
        }
        if (self::hasPickedTeam($userId, $teamId)) {
            return "You have already picked this team this season.";
        }

        // Insert the pick
        $stmt = $pdo->prepare("INSERT INTO picks (user_id, team_id, week) VALUES (?, ?, ?)");
        return $stmt->execute([$userId, $teamId, $week]);
    }

    // Get all picks for a user
    public static function getUserPicks($userId) {
        global $pdo;
        $stmt = $pdo->prepare("
            SELECT p.week, t.name AS team_name 
            FROM picks p
            JOIN teams t ON p.team_id = t.id
            WHERE p.user_id = ?
            ORDER BY p.week ASC
        ");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
