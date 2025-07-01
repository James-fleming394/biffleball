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
        SELECT 
            u.username,
            SUM(t.wins) AS total_team_wins,
            SUM(t.wins + t.losses) AS total_games
        FROM picks p
        JOIN users u ON p.user_id = u.id
        JOIN teams t ON p.team_id = t.id
        GROUP BY u.id
        HAVING total_games > 0
        ORDER BY (100 - (total_team_wins / total_games) * 100) ASC
    ");

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Format SOTU as 100 - win %
    foreach ($results as &$row) {
        $winPercent = $row['total_team_wins'] / $row['total_games'];
        $row['sotu'] = round(100 - ($winPercent * 100), 2);
        unset($row['total_team_wins'], $row['total_games']); // clean up
    }

    return $results;
    }

    public static function getTopPicksForWeek($week) {
    global $pdo;

    // First, get total number of picks that week
    $totalStmt = $pdo->prepare("SELECT COUNT(*) as total FROM picks WHERE week = ?");
    $totalStmt->execute([$week]);
    $total = $totalStmt->fetchColumn();

    if (!$total) return [];

    // Get top 5 teams
    $stmt = $pdo->prepare("
        SELECT t.name AS team_name, COUNT(p.id) AS pick_count
        FROM teams t
        JOIN picks p ON p.team_id = t.id
        WHERE p.week = ?
        GROUP BY t.id
        ORDER BY pick_count DESC
        LIMIT 5
    ");
    $stmt->execute([$week]);

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Add percentage field to each result
    foreach ($results as &$row) {
        $row['percentage'] = round(($row['pick_count'] / $total) * 100);
    }

    return $results;
    }

    public static function getWeeksWithPicks() {
    global $pdo;

    $stmt = $pdo->query("
        SELECT DISTINCT week
        FROM picks
        ORDER BY week ASC
        ");
    
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    public static function getMLBWeeklyWinTotals($week) {
        global $pdo;

        $stmt = $pdo->prepare("
            SELECT t.name AS team_name, t.abbreviation, tw.wins
            FROM team_weekly_wins tw
            JOIN teams t ON tw.team_id = t.id
            WHERE tw.week = ?
            ORDER BY tw.wins DESC
        ");
        $stmt->execute([$week]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getUserPicksByWeek() {
        global $pdo;

        $stmt = $pdo->query("
            SELECT u.username, p.week, t.abbreviation AS team
            FROM users u
            LEFT JOIN picks p ON u.id = p.user_id
            LEFT JOIN teams t ON p.team_id = t.id
            ORDER BY u.username ASC, p.week ASC
        ");

        $raw = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Structure data: username => [ week => team_abbreviation ]
        $data = [];
        foreach ($raw as $row) {
            $user = $row['username'];
            $week = $row['week'];
            $team = $row['team'];

            if (!isset($data[$user])) {
                $data[$user] = [];
            }

            if ($week !== null) {
                $data[$user][intval($week)] = $team;
            }
        }

        return $data;
    }

}
