<?php include 'header.php'; ?>

<style>
.standings-section {
    max-width: 90%;
    margin: 3rem auto;
    text-align: center;
    padding: 2rem;
    background: linear-gradient(135deg, #ffffff, #f8f9ff);
    border-radius: 12px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
}

.standings-section h2 {
    font-size: 2rem;
    margin-bottom: 1.5rem;
    color: #1d3557;
}

.standings-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 1rem;
    overflow-x: auto;
}

.standings-table thead {
    background-color: #0074D9;
    color: white;
}

.standings-table th, 
.standings-table td {
    padding: 0.85rem 1rem;
    border: 1px solid #ddd;
    text-align: center;
}

.standings-table tr:nth-child(even) {
    background-color: #f2f2f2;
}

.standings-table tr:hover {
    background-color: #e8f4ff;
}

.top1 td {
    background-color: #ffeaa7 !important;
    font-weight: bold;
}

.top2 td {
    background-color: #dfe6e9 !important;
    font-weight: bold;
}

.top3 td {
    background-color: #fab1a0 !important;
    font-weight: bold;
}

@media (max-width: 768px) {
    .standings-section {
        padding: 1rem;
    }

    .standings-table th, 
    .standings-table td {
        padding: 0.6rem;
        font-size: 0.9rem;
    }
}

</style>

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

