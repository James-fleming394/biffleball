<?php
require_once __DIR__ . '/../config.php';

class Standings {
    public static function getRankings() {
        global $pdo;

        // Query to count wins based on team performance
        $stmt = $pdo->query("
            SELECT u.id, u.username, COUNT(p.id) AS wins
            FROM users u
            LEFT JOIN picks p ON u.id = p.user_id
            LEFT JOIN teams t ON p.team_id = t.id
            WHERE t.wins > 0  -- Only count picks for teams that won at least once
            GROUP BY u.id
            ORDER BY wins DESC, u.username ASC
        ");

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
