<?php
require_once __DIR__ . '/../config.php';

class Analytics {
    public static function getWAAStats() {
        global $pdo;

        // Get all users
        $usersStmt = $pdo->query("SELECT id, username FROM users ORDER BY username ASC");
        $usersRaw = $usersStmt->fetchAll(PDO::FETCH_ASSOC);

        // Get all teams
        $teamsStmt = $pdo->query("SELECT id, abbreviation FROM teams ORDER BY abbreviation ASC");
        $teams = $teamsStmt->fetchAll(PDO::FETCH_ASSOC);

        // Initialize user data indexed by username
        $users = [];
        foreach ($usersRaw as $user) {
            $users[$user['username']] = array_fill_keys(array_column($teams, 'abbreviation'), 0);
        }

        // Fetch picks (simulate 1 win per pick)
        $picksStmt = $pdo->query("
            SELECT picks.user_id, teams.abbreviation, users.username
            FROM picks
            JOIN teams ON picks.team_id = teams.id
            JOIN users ON picks.user_id = users.id
        ");
        $picks = $picksStmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($picks as $pick) {
            $username = $pick['username'];
            $abbr = $pick['abbreviation'];
            if (isset($users[$username][$abbr])) {
                $users[$username][$abbr]++;
            }
        }

        // Calculate league averages
        $leagueAverages = array_fill_keys(array_column($teams, 'abbreviation'), 0);
        $userCount = count($users);

        foreach ($teams as $team) {
            $abbr = $team['abbreviation'];
            $total = 0;
            foreach ($users as $userData) {
                $total += $userData[$abbr];
            }
            $leagueAverages[$abbr] = $userCount > 0 ? round($total / $userCount, 2) : 0;
        }

        // Calculate users with team available
        $availability = array_fill_keys(array_column($teams, 'abbreviation'), 0);
        foreach ($teams as $team) {
            $abbr = $team['abbreviation'];
            $availableCount = 0;
            foreach ($users as $userData) {
                if ($userData[$abbr] === 0) {
                    $availableCount++;
                }
            }
            $availability[$abbr] = $availableCount;
        }

        return [
            'users' => $users,
            'teams' => $teams,
            'leagueAverage' => $leagueAverages,
            'usersWithTeamAvailable' => $availability
        ];
    }

    public static function getWeeklyPickDistribution($week) {
        global $pdo;

        $stmt = $pdo->prepare("
            SELECT t.name AS team_name, COUNT(p.id) AS pick_count
            FROM teams t
            LEFT JOIN picks p ON t.id = p.team_id AND p.week = ?
            GROUP BY t.id
            HAVING pick_count > 0
            ORDER BY pick_count DESC
        ");
        $stmt->execute([$week]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getSOTUStats() {
        global $pdo;
        $stmt = $pdo->query("
            SELECT users.username, ROUND(AVG(teams.win_total), 2) AS sotu
            FROM picks
            JOIN users ON picks.user_id = users.id
            JOIN teams ON picks.team_id = teams.id
            GROUP BY users.id
            ORDER BY users.username
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
