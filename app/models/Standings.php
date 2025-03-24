<?php
require_once __DIR__ . '/../config.php';

class Standings {
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
}

