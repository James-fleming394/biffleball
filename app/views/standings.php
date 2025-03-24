<?php include 'header.php'; ?>

<h2>League Standings</h2>

<table border="1" cellpadding="8" cellspacing="0" style="margin: auto;">
    <tr>
        <th>Rank</th>
        <th>Username</th>
        <th>Total Wins</th>
        <th>SOTU</th>
        <th>Team This Week</th>
    </tr>
    <?php 
    $rank = 1;
    foreach ($users as $user): ?>
        <tr>
            <td><?php echo $rank++; ?></td>
            <td><?php echo htmlspecialchars($user['username']); ?></td>
            <td>0</td> <!-- Static until wins are tracked -->
            <td>0</td> <!-- Static until SOTU is implemented -->
            <td><?php echo $user['current_team'] ?? '—'; ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<?php include 'footer.php'; ?>

