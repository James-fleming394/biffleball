<?php include 'header.php'; ?>

<h2>Pick Your Team for This Week</h2>

<?php if (!empty($currentPick)): ?>
    <p><strong>Current Pick:</strong> <?php echo htmlspecialchars($currentPick['team_name']); ?> (Week <?php echo $currentPick['week']; ?>)</p>
<?php else: ?>
    <p><strong>No pick has been made yet for this week.</strong></p>
<?php endif; ?>

<?php if (!empty($upcomingPick)): ?>
    <p><strong>Upcoming Pick:</strong> <?php echo htmlspecialchars($upcomingPick['team_name']); ?> (Week <?php echo $upcomingPick['week']; ?>)</p>
<?php endif; ?>

<form action="index.php?page=pick-team" method="POST">
    <label for="team_id">Select Team:</label>
    <select name="team_id" required>
        <?php foreach ($teams as $team): ?>
            <option value="<?php echo $team['id']; ?>" <?php echo (!empty($currentPick) && $currentPick['team_id'] == $team['id']) ? 'selected' : ''; ?>>
                <?php echo htmlspecialchars($team['name']); ?>
            </option>
        <?php endforeach; ?>
    </select>
    <button type="submit">Submit Pick</button>
</form>

<?php if (!empty($currentPick)): ?>
    <h3>Change Your Pick</h3>
    <form action="index.php?page=change-pick" method="POST">
        <label for="new_team_id">Change to:</label>
        <select name="new_team_id" required>
            <?php foreach ($teams as $team): ?>
                <option value="<?php echo $team['id']; ?>"><?php echo htmlspecialchars($team['name']); ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Change Pick</button>
    </form>
<?php endif; ?>

<?php include 'footer.php'; ?>

