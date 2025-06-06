<?php include 'header.php'; ?>

<div class="profile-container">
    <div class="profile-header">
        <form action="upload_avatar.php" method="POST" enctype="multipart/form-data" class="avatar-form">
            <div class="avatar-container">
                <img src="/images/avatars/default.png" alt="User Avatar" class="avatar-img" id="avatarPreview">
                <div class="avatar-overlay">Change</div>
                <input type="file" name="avatar" id="avatarInput" accept="image/*">
            </div>
        </form>
        <div class="user-details">
            <p><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
        </div>
    </div>

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

    <a href="index.php?page=pick-team" class="pick-link">Make a Pick</a>
</div>

<?php include 'footer.php'; ?>
