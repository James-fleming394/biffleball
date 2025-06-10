<?php
require_once __DIR__ . '/../app/config.php';

try {
    global $pdo;

    $stmt = $pdo->query("
        SELECT p.user_id, p.week, t.id AS team_id, tww.wins
        FROM picks p
        JOIN teams t ON p.team_id = t.id
        JOIN team_weekly_wins tww ON tww.team_id = t.id AND tww.week = p.week
    ");

    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $insertStmt = $pdo->prepare("
        INSERT INTO user_weekly_wins (user_id, week, wins)
        VALUES (?, ?, ?)
        ON DUPLICATE KEY UPDATE wins = VALUES(wins)
    ");

    $inserted = 0;
    foreach ($rows as $row) {
        $insertStmt->execute([$row['user_id'], $row['week'], $row['wins']]);
        $inserted++;
    }

    echo "✅ Successfully inserted/updated {$inserted} rows into user_weekly_wins." . PHP_EOL;

} catch (PDOException $e) {
    echo "❌ Error: " . $e->getMessage() . PHP_EOL;
}