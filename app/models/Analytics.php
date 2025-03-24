<?php
require_once __DIR__ . '/../config.php';

class Analytics {
    public static function getSOTUByUser() {
        global $pdo;

        $stmt = $pdo->prepare("
            SELECT 
                users.username,
                ROUND(AVG(teams.win_total), 2) AS sotu
            FROM users
            JOIN picks ON users.id = picks.user_id
            JOIN teams ON picks.team_id = teams.id
            GROUP BY users.id
            ORDER BY sotu ASC
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}