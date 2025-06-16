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

    $stmt = $pdo->query("
        SELECT 
            u.username,
            COALESCE(SUM(uw.wins), 0) AS total_wins,
            t.name AS current_team
        FROM users u
        LEFT JOIN user_weekly_wins uw ON u.id = uw.user_id
        LEFT JOIN picks p ON u.id = p.user_id AND p.week = WEEK(CURDATE(), 1)
        LEFT JOIN teams t ON p.team_id = t.id
        GROUP BY u.id
        ORDER BY total_wins DESC, u.username ASC
    ");

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

}