<?php
require_once __DIR__ . '/../config.php';

class Analytics {
    public static function getWAAStats() {
        global $pdo;

        // Fetch all users
        $usersStmt = $pdo->query("SELECT id, username FROM users ORDER BY username ASC");
        $users = $usersStmt->fetchAll(PDO::FETCH_ASSOC);

        // Fetch all teams with win totals
        $teamsStmt = $pdo->query("SELECT id, name, win_total FROM teams ORDER BY name ASC");
        $teams = $teamsStmt->fetchAll(PDO::FETCH_ASSOC);

        // Calculate simulated average weekly wins for each team
        $teamAverages = [];
        foreach ($teams as $team) {
            $teamAverages[$team['id']] = round($team['win_total'] / 26, 2);
        }

        // Fetch all picks
        $picksStmt = $pdo->query("SELECT user_id, team_id FROM picks");
        $picks = $picksStmt->fetchAll(PDO::FETCH_ASSOC);

        // Initialize stats
        $userTeamWins = [];
        $teamUserSet = [];

        foreach ($users as $user) {
            $userTeamWins[$user['id']] = ['username' => $user['username']];
            foreach ($teams as $team) {
                $userTeamWins[$user['id']][$team['name']] = 0;
            }
        }

        // Populate wins per user/team
        foreach ($picks as $pick) {
            $userId = $pick['user_id'];
            $teamId = $pick['team_id'];

            $teamName = '';
            foreach ($teams as $team) {
                if ($team['id'] == $teamId) {
                    $teamName = $team['name'];
                    break;
                }
            }

            if ($teamName && isset($teamAverages[$teamId])) {
                $userTeamWins[$userId][$teamName] += $teamAverages[$teamId];
                $teamUserSet[$teamName][$userId] = true;
            }
        }

        // Calculate league averages and availability
        $leagueAverage = [];
        $usersWithTeamAvailable = [];

        foreach ($teams as $team) {
            $teamName = $team['name'];
            $sum = 0;
            $count = 0;

            foreach ($userTeamWins as $row) {
                $sum += $row[$teamName];
                $count++;
            }

            $leagueAverage[$teamName] = $count ? round($sum / $count, 2) : 0;
            $usersWithTeamAvailable[$teamName] = count($users) - count($teamUserSet[$teamName] ?? []);
        }

        return [
            'users' => array_values($userTeamWins),
            'teams' => array_column($teams, 'name'),
            'leagueAverage' => $leagueAverage,
            'usersWithTeamAvailable' => $usersWithTeamAvailable
        ];
    }
}