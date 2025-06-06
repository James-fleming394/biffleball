<?php include 'header.php'; ?>

<div class="profile-hero">
    <div class="avatar-placeholder">
        <img src="/images/avatars/default.png" alt="User Avatar">
    </div>
    <div class="profile-info">
        <h2><?php echo htmlspecialchars($user['username']); ?></h2>
        <p>Email: <?php echo htmlspecialchars($user['email']); ?></p>
    </div>
</div>

<div class="profile-stats">
    <div class="stat-card">
        <h4>Total Wins</h4>
        <p>0</p>
    </div>
    <div class="stat-card">
        <h4>WAA</h4>
        <p>—</p>
    </div>
    <div class="stat-card">
        <h4>SOTU</h4>
        <p>0</p>
    </div>
</div>

<div class="standings-section">
    <h3>📋 Weekly Picks</h3>
    <table class="picks-table">
        <thead>
            <tr>
                <th>Week</th>
                <th>Team</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($picks as $pick): ?>
            <tr>
                <td><?php echo $pick['week']; ?></td>
                <td>
                    <img src="/images/logos/<?php echo strtolower(str_replace(' ', '', $pick['team_name'])); ?>.png" 
                        alt="<?php echo $pick['team_name']; ?> logo" class="team-logo">
                    <?php echo $pick['team_name']; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<a href="index.php?page=pick-team" class="pick-button">Make Your Pick →</a>

<?php include 'footer.php'; ?>
