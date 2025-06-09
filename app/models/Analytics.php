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

    // Initialize empty wins for each user
    $users = [];
    foreach ($usersRaw as $user) {
        $users[$user['id']] = [
            'username' => $user['username'],
            'team_wins' => array_fill_keys(array_column($teams, 'abbreviation'), 0),
        ];
    }

    // Fetch picks (simulate 1 win per pick for now)
    $picksStmt = $pdo->query("
        SELECT picks.user_id, teams.abbreviation
        FROM picks
        JOIN teams ON picks.team_id = teams.id
    ");
    $picks = $picksStmt->fetchAll(PDO::FETCH_ASSOC);

    // Tally wins per team per user
    foreach ($picks as $pick) {
        $userId = $pick['user_id'];
        $abbr = $pick['abbreviation'];
        if (isset($users[$userId]['team_wins'][$abbr])) {
            $users[$userId]['team_wins'][$abbr]++;
        }
    }

    // Simulate league average per team
    $leagueAverages = array_fill_keys(array_column($teams, 'abbreviation'), 0);
    $userCount = count($users);

    foreach ($teams as $team) {
        $abbr = $team['abbreviation'];
        $totalWins = 0;
        foreach ($users as $user) {
            $totalWins += $user['team_wins'][$abbr];
        }
        $leagueAverages[$abbr] = $userCount > 0 ? round($totalWins / $userCount, 2) : 0;
    }

    // Simulate availability per team
    $availability = array_fill_keys(array_column($teams, 'abbreviation'), 0);
    foreach ($teams as $team) {
        $abbr = $team['abbreviation'];
        $count = 0;
        foreach ($users as $user) {
            if ($user['team_wins'][$abbr] === 0) {
                $count++;
            }
        }
        $availability[$abbr] = $count;
    }

    return [
        'users' => array_values($users), // reset to sequential array
        'teams' => $teams,
        'leagueAverages' => $leagueAverages,
        'availability' => $availability
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
}