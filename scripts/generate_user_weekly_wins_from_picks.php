<?php
require_once __DIR__ . '/../app/config.php';

try {
    // Get all picks
    $stmt = $pdo->query("SELECT user_id, team_id, week FROM picks");
    $picks = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $insertStmt = $pdo->prepare("
        INSERT INTO user_weekly_wins (user_id, week, wins)
        VALUES (:user_id, :week, :wins)
        ON DUPLICATE KEY UPDATE wins = VALUES(wins)
    ");

    $count = 0;

    foreach ($picks as $pick) {
        $userId = $pick['user_id'];
        $teamId = $pick['team_id'];
        $week = $pick['week'];

        // Get the win total for the team in that week
        $winStmt = $pdo->prepare("SELECT wins FROM team_weekly_wins WHERE team_id = :team_id AND week = :week");
        $winStmt->execute(['team_id' => $teamId, 'week' => $week]);
        $result = $winStmt->fetch(PDO::FETCH_ASSOC);

        if ($result && isset($result['wins'])) {
            $wins = $result['wins'];

            $insertStmt->execute([
                'user_id' => $userId,
                'week' => $week,
                'wins' => $wins
            ]);

            $count++;
        }
    }

    echo "✅ Successfully inserted/updated $count rows into user_weekly_wins.\n";

} catch (PDOException $e) {
    echo "❌ Error: " . $e->getMessage();
}