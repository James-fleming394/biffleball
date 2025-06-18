<?php
require_once __DIR__ . '/../app/config.php';

$week = 25;

try {
    // Get all teams
    $teamsStmt = $pdo->query("SELECT id FROM teams");
    $allTeams = $teamsStmt->fetchAll(PDO::FETCH_COLUMN);

    // Get all users except admin (ID = 1)
    $usersStmt = $pdo->query("SELECT id FROM users WHERE id != 1 ORDER BY id ASC LIMIT 99");
    $userIds = $usersStmt->fetchAll(PDO::FETCH_COLUMN);

    $insertStmt = $pdo->prepare("
        INSERT INTO picks (user_id, team_id, week, created_at)
        VALUES (:user_id, :team_id, :week, NOW())
        ON DUPLICATE KEY UPDATE team_id = VALUES(team_id), created_at = NOW()
    ");

    $count = 0;

    foreach ($userIds as $userId) {
        // Get teams this user has already picked
        $pickedStmt = $pdo->prepare("SELECT team_id FROM picks WHERE user_id = :user_id");
        $pickedStmt->execute(['user_id' => $userId]);
        $pickedTeams = $pickedStmt->fetchAll(PDO::FETCH_COLUMN);

        // Determine available teams
        $availableTeams = array_diff($allTeams, $pickedTeams);
        if (empty($availableTeams)) {
            continue; // user has picked all teams
        }

        // Pick a random team from available options
        $teamId = $availableTeams[array_rand($availableTeams)];

        // Insert pick
        $insertStmt->execute([
            'user_id' => $userId,
            'team_id' => $teamId,
            'week' => $week
        ]);

        $count++;
    }

    echo "✅ Successfully inserted/updated $count picks for week $week (excluding admin).\n";

} catch (PDOException $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}
