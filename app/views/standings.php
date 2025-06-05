<?php include 'header.php'; ?>

<div class="standings-section">
    <h2>🏆 League Standings</h2>

    <table class="standings-table">
        <thead>
            <tr>
                <th>Rank</th>
                <th>Username</th>
                <th>Total Wins</th>
                <th>WAA</th>
                <th>SOTU</th>
                <th>Team This Week</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $rank = 1;
            foreach ($users as $user): 
                $rowClass = $rank === 1 ? 'top1' : ($rank === 2 ? 'top2' : ($rank === 3 ? 'top3' : ''));
            ?>
                <tr class="<?php echo $rowClass; ?>">
                    <td>
                        <?php 
                        echo $rank === 1 ? '🥇' : ($rank === 2 ? '🥈' : ($rank === 3 ? '🥉' : $rank));
                        ?>
                    </td>
                    <td><?php echo htmlspecialchars($user['username']); ?></td>
                    <td>0</td> <!-- Placeholder for Total Wins -->
                    <td>—</td> <!-- Placeholder for WAA -->
                    <td>0</td> <!-- Placeholder for SOTU -->
                    <td><?php echo $user['current_team'] ?? '—'; ?></td>
                </tr>
            <?php $rank++; endforeach; ?>
        </tbody>
    </table>
</div>

<?php include 'footer.php'; ?>

