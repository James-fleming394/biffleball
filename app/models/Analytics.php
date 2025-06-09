<?php
require_once __DIR__ . '/../config.php';

class Analytics {
    public static function getWAAStats() {
        global $pdo;

        // Get all teams
        $teamsStmt = $pdo->query("SELECT id, name FROM teams ORDER BY name");
        $teams = $teamsStmt->fetchAll(PDO::FETCH_ASSOC);

        // Get all users
        $usersStmt = $pdo->query("SELECT id, username FROM users ORDER BY username");
        $users = $usersStmt->fetchAll(PDO::FETCH_ASSOC);

        // Initialize array
        $data = [];

        foreach ($users as $user) {
            $userData = [
                'username' => $user['username'],
                'team_wins' => []
            ];

            foreach ($teams as $team) {
                // Count how many times the user picked this team
                $stmt = $pdo->prepare("
                    SELECT COUNT(*) as win_count
                    FROM picks
                    WHERE user_id = ? AND team_id = ?
                ");
                $stmt->execute([$user['id'], $team['id']]);
                $result = $stmt->fetch(PDO::FETCH_ASSOC);

                $userData['team_wins'][$team['name']] = (int) $result['win_count'];
            }

            $data['users'][] = $userData;
        }

        // League Average With Team
        $leagueAverages = [];
        foreach ($teams as $team) {
            $stmt = $pdo->prepare("
                SELECT COUNT(*) as total
                FROM picks
                WHERE team_id = ?
            ");
            $stmt->execute([$team['id']]);
            $total = $stmt->fetchColumn();
            $leagueAverages[$team['name']] = (int) $total;
        }

        // Users With Team Available
        $availability = [];
        foreach ($teams as $team) {
            $stmt = $pdo->prepare("
                SELECT COUNT(*) as available
                FROM users
                WHERE id NOT IN (
                    SELECT user_id FROM picks WHERE team_id = ?
                )
            ");
            $stmt->execute([$team['id']]);
            $count = $stmt->fetchColumn();
            $availability[$team['name']] = (int) $count;
        }

        return [
            'teams' => $teams,
            'users' => $data['users'],
            'leagueAverages' => $leagueAverages,
            'availability' => $availability
        ];
    }
}
