<?php include 'header.php'; ?>

<style>
.standings-wrapper {
    margin-top: 0;
    padding: 1rem;
    background: linear-gradient(135deg, rgb(27, 19, 183), rgb(110, 174, 246));
    margin-bottom: -5rem;
}

.standings-section {
    max-width: 80%;
    margin: 3rem auto;
    text-align: center;
    padding: 2rem;
    background: linear-gradient(135deg, #ffffff, #f8f9ff);
    border-radius: 5px;
}

.standings-section h2 {
    font-size: 2.2rem;
    color: #1e3d58;
    margin-bottom: 2rem;
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

.team-logo {
    height: 30px;
    margin-right: 8px;
    vertical-align: middle;
}

.profile-link {
    color: #0074D9;
    font-weight: bold;
    text-decoration: none;
}

.profile-link:hover {
    text-decoration: underline;
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

<div class="standings-wrapper">
    <div class="standings-section">
        <h2>🏆 League Standings</h2>

        <table class="standings-table" id="standingsTable">
            <thead>
                <tr>
                    <th>Rank</th>
                    <th class="sortable" data-key="username">Username</th>
                    <th class="sortable" data-key="totalWins">Total Wins</th>
                    <th class="sortable" data-key="waa">WAA</th>
                    <th class="sortable" data-key="sotu">SOTU</th>
                    <th>Team This Week</th>
                    <th>Profile</th>
                </tr>
            </thead>
            <tbody id="standingsBody">
                <?php 
                $rank = 1;
                foreach ($users as $user): 
                    $rowClass = $rank === 1 ? 'top1' : ($rank === 2 ? 'top2' : ($rank === 3 ? 'top3' : ''));
                ?>
                <tr class="<?php echo $rowClass; ?>"
                    data-username="<?php echo strtolower($user['username']); ?>"
                    data-totalWins="<?php echo (int)$user['total_wins']; ?>"
                    data-sotu="<?php echo (float)$user['sotu']; ?>"
                    data-waa="<?php echo (float)$user['waa']; ?>"
                >
                    <td class="rank-cell"><?php echo $rank === 1 ? '🥇' : ($rank === 2 ? '🥈' : ($rank === 3 ? '🥉' : $rank)); ?></td>
                    <td><?php echo htmlspecialchars($user['username']); ?></td>
                    <td><?php echo (int) $user['total_wins']; ?></td>
                    <td><?php echo number_format($user['waa'], 2); ?></td>
                    <td><?php echo number_format($user['sotu'], 2); ?>%</td>
                    <td>
                        <?php
                        $team = $user['current_team'] ?? '';
                        if ($team) {
                            $teamNameOnly = strtolower(preg_replace('/^(arizona|atlanta|baltimore|boston|chicago|cincinnati|cleveland|colorado|detroit|houston|kansas city|los angeles|miami|milwaukee|minnesota|new york|oakland|philadelphia|pittsburgh|san diego|san francisco|seattle|st\.? louis|tampa bay|texas|toronto|washington)\s+/i', '', $team));
                            $filename = str_replace(' ', '', $teamNameOnly) . '.png';
                            $logoPath = "/images/logos/" . $filename;
                            echo "<img src='$logoPath' alt='$team' class='team-logo'> " . htmlspecialchars($team);
                        } else {
                            echo '—';
                        }
                        ?>
                    </td>
                    <td>
                        <a href="index.php?page=profile&user=<?php echo urlencode($user['username']); ?>" class="profile-link">
                            View
                        </a>
                    </td>
                </tr>
                <?php $rank++; endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'footer.php'; ?>