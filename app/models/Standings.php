<?php
require_once __DIR__ . '/../config.php';

class Standings {
    // Used by the standings page
    public static function getAllUsersWithCurrentTeam() {
        global $pdo;

        $week = date('W');

        $stmt = $pdo->prepare("
            SELECT 
                users.username,
                teams.name AS current_team
            FROM users
            LEFT JOIN picks ON users.id = picks.user_id AND picks.week = ?
            LEFT JOIN teams ON picks.team_id = teams.id
            ORDER BY users.username ASC
        ");
        $stmt->execute([$week]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Used for ranking users (e.g., on profile page)
    public static function getAll() {
        global $pdo;

        $stmt = $pdo->prepare("
            SELECT users.username, COUNT(picks.id) AS total_wins
            FROM users
            LEFT JOIN picks ON users.id = picks.user_id
            GROUP BY users.id
            ORDER BY total_wins DESC
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}