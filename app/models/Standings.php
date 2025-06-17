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

    $week = date('W');

    // Get the league average wins per user
    $avgStmt = $pdo->query("SELECT AVG(total) AS league_avg FROM (
        SELECT user_id, SUM(wins) AS total 
        FROM user_weekly_wins 
        GROUP BY user_id
    ) AS user_totals");
    $leagueAvg = $avgStmt->fetch(PDO::FETCH_ASSOC)['league_avg'] ?? 0;

    $stmt = $pdo->prepare("
        SELECT 
            u.username, 
            COALESCE(w.total_wins, 0) AS total_wins,
            ROUND(COALESCE(w.total_wins, 0) - ?, 2) AS waa,
            (
                SELECT t.name 
                FROM picks p2 
                JOIN teams t ON p2.team_id = t.id 
                WHERE p2.user_id = u.id AND p2.week = ? 
                LIMIT 1
            ) AS current_team,
            ROUND(COALESCE((
                SELECT AVG(team_avg.wins / 162)
                FROM picks p3
                JOIN teams team_avg ON p3.team_id = team_avg.id
                WHERE p3.user_id = u.id
            ), 0) * 100, 2) AS sotu
        FROM users u
        LEFT JOIN (
            SELECT user_id, SUM(wins) AS total_wins 
            FROM user_weekly_wins 
            GROUP BY user_id
        ) w ON u.id = w.user_id
        ORDER BY total_wins DESC, u.username ASC
    ");

    $stmt->execute([$leagueAvg, $week]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
}