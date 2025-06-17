<?php
require_once __DIR__ . '/../app/config.php';

try {
    global $pdo;

    // Step 1: Get all teams
    $teamsStmt = $pdo->query("SELECT id FROM teams");
    $teams = $teamsStmt->fetchAll(PDO::FETCH_ASSOC);

    $updateStmt = $pdo->prepare("UPDATE teams SET wins = ?, losses = ? WHERE id = ?");

    $updated = 0;

    foreach ($teams as $team) {
        $teamId = $team['id'];

        // Step 2: Sum weekly wins
        $sumStmt = $pdo->prepare("SELECT SUM(wins) AS total_wins FROM team_weekly_wins WHERE team_id = ?");
        $sumStmt->execute([$teamId]);
        $result = $sumStmt->fetch(PDO::FETCH_ASSOC);

        $wins = (int)$result['total_wins'];
        $losses = 162 - $wins;

        // Step 3: Update teams table
        $updateStmt->execute([$wins, $losses, $teamId]);
        $updated++;
    }

    echo "✅ Updated $updated teams with total wins and losses.\n";

} catch (PDOException $e) {
    echo "❌ Error: " . $e->getMessage();
}