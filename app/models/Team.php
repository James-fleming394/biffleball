<?php
require_once __DIR__ . '/../config.php';

class Team {
    // Get all teams
    public static function getAll() {
        global $pdo;
        $stmt = $pdo->query("SELECT id, name FROM teams ORDER BY name ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Update team wins (used by API)
    public static function updateWins($abbreviation, $wins) {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE teams SET wins = ? WHERE abbreviation = ?");
        return $stmt->execute([$wins, $abbreviation]);
    }
}
?>
