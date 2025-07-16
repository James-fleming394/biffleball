<?php include 'header.php'; ?>

<style>
.profile-container {
    max-width: 800px;
    margin: 2rem auto;
    background: #fff;
    padding: 2rem;
    border-radius: 12px;
    box-shadow: 0 12px 16px rgba(0, 0, 0, 0.1);
}

.profile-header {
    display: flex;
    align-items: center;
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.avatar-form {
    position: relative;
}

.avatar-container {
    position: relative;
    width: 100px;
    height: 100px;
    border-radius: 50%;
    overflow: hidden;
    border: 2px solid #0074D9;
    cursor: pointer;
}

.avatar-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: opacity 0.3s ease;
}

.avatar-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.6);
    color: #fff;
    font-size: 0.9rem;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.avatar-container:hover .avatar-overlay {
    opacity: 1;
}

#avatarInput {
    display: none;
}

.user-details {
    flex-grow: 1;
}

.user-details p {
    font-size: 1.1rem;
    margin: 0.3rem 0;
}

.picks-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 1.5rem;
}

.picks-table th,
.picks-table td {
    border: 1px solid #ddd;
    padding: 0.75rem;
    text-align: center;
}

.picks-table th {
    background-color: #0074D9;
    color: white;
}

.picks-table tr:nth-child(even) {
    background-color: #f9f9f9;
}

.pick-link {
    display: inline-block;
    margin-top: 1rem;
    background-color: #0074D9;
    color: #fff;
    padding: 0.6rem 1.2rem;
    margin-bottom: 1rem;
    border-radius: 6px;
    text-decoration: none;
    font-weight: 600;
    transition: background 0.3s ease;
}

.pick-link:hover {
    background-color: #005fa3;
}

.pick-link-wrapper {
    text-align: center;
}

.edit-profile-btn {
    display: inline-block;
    margin-top: 1rem;
    padding: 0.5rem 1rem;
    border: 2px solid #0074D9;
    background-color: transparent;
    color: #0074D9;
    font-weight: 600;
    border-radius: 6px;
    text-decoration: none;
    transition: all 0.3s ease;
}

.edit-profile-btn:hover {
    background-color: #0074D9;
    color: #fff;
}

.edit-mode label {
    display: block;
    margin-bottom: 1rem;
}

.edit-mode input {
    width: 100%;
    padding: 0.5rem;
    font-size: 1rem;
    margin-top: 0.25rem;
    border: 1px solid #ccc;
    border-radius: 6px;
    box-sizing: border-box;
}

.edit-mode button[type="submit"],
.edit-mode a {
    display: inline-block;
    margin-top: 0.5rem;
    padding: 10px 18px;
    font-size: 1rem;
    border-radius: 6px;
    text-decoration: none;
    transition: background 0.3s ease;
}

.edit-mode button[type="submit"] {
    background-color: #0074D9;
    color: white;
    border: none;
    font-weight: 600;
    margin-right: 1rem;
    cursor: pointer;
}

.edit-mode button[type="submit"]:hover {
    background-color: #005fa3;
}

.edit-mode a {
    background-color: #e0e0e0;
    color: #333;
    font-weight: 500;
    border: 1px solid #ccc;
}

.edit-mode a:hover {
    background-color: #d5d5d5;
}

.stats-summary {
    background: #f4f9ff;
    padding: 1rem 1.5rem;
}

</style>

<div class="profile-container">
    <div class="profile-header">
        <form action="upload_avatar.php" method="POST" enctype="multipart/form-data" class="avatar-form">
            <div class="avatar-container">
                <img src="/images/avatars/<?php echo htmlspecialchars($user['avatar'] ?? 'default.png'); ?>" alt="User Avatar" class="avatar-img" id="avatarPreview">
                <div class="avatar-overlay">Change</div>
                <input type="file" name="avatar" id="avatarInput" accept="image/*">
            </div>
        </form>
        <div class="user-details">
            <div class="view-mode">
            <p><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
            <a href="#" class="edit-profile-btn" onclick="toggleEditForm(event)">Edit Profile Info</a>
        </div>
        <form class="edit-mode" style="display: none;" action="index.php?page=update-user" method="POST">
        <label>
            Username:
            <input type="text" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
        </label>
        <label>
            Email:
            <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
        </label>
        <button type="submit">Save Changes</button>
        <a href="#" onclick="toggleEditForm(event)">Cancel</a>
    </form>
</div>

    </div>

    <?php
        // Compute leaderboard rank
        $leaderboard = Standings::getAll();
        $rank = 1;
        foreach ($leaderboard as $entry) {
            if ($entry['username'] === $user['username']) break;
            $rank++;
        }

        // Compute pick stats
        $totalPicks = count($picks);
        $teamsUsed = array_unique(array_column($picks, 'team_name'));
        $uniqueTeams = count($teamsUsed);
    ?>
    <p><strong>🏆 Leaderboard Rank:</strong> <?php echo $rank; ?> out of <?php echo count($leaderboard); ?></p>

    <h3>My Picks</h3>
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
                    <td><?php echo htmlspecialchars($pick['team_name']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="pick-link-wrapper">
        <a href="index.php?page=pick-team" class="pick-link">Make a Pick</a>
    </div>

    <div class="stats-summary">
        <h3>📈 Stats Summary</h3>
            <p><strong>Current Win Streak:</strong> <?php echo $user['current_win_streak'] ?? 0; ?></p>
            <p><strong>Longest Win Streak:</strong> <?php echo $user['longest_win_streak'] ?? 0; ?></p>
            <p><strong>SOTU:</strong> <?php echo number_format($user['sotu'] ?? 0, 2); ?>%</p>
            <p><strong>WAA:</strong> <?php echo number_format($user['waa'] ?? 0, 2); ?></p>
            <p><strong>Years in League:</strong> <?php echo $user['seasons'] ?? 1; ?></p>
    </div>

</div>

<script>
document.querySelector('.avatar-container').addEventListener('click', () => {
    document.getElementById('avatarInput').click();
});

document.getElementById('avatarInput').addEventListener('change', function () {
    if (this.files && this.files[0]) {
        document.querySelector('.avatar-form').submit();
    }
});

function toggleEditForm(e) {
    e.preventDefault();
    const viewMode = document.querySelector('.view-mode');
    const editMode = document.querySelector('.edit-mode');
    viewMode.style.display = viewMode.style.display === 'none' ? 'block' : 'none';
    editMode.style.display = editMode.style.display === 'none' ? 'block' : 'none';
}
</script>

<?php include 'footer.php'; ?>