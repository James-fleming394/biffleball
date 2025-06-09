<?php include 'header.php'; ?>

<div class="pick-container">
    <h2>🏟️ Pick Your Team for This Week</h2>

    <div class="countdown" id="countdown"></div>

    <?php if (!empty($currentPick)): ?>
        <div class="card-wrapper">
            <div class="card">
                <div class="card-front" style="border-color: <?php echo getTeamColor($currentPick['team_name']); ?>">
                    <div class="pennant">Biffleball</div>
                    <h3>Week <?php echo $currentPick['week']; ?></h3>
                    <img src="/images/logos/<?php echo getTeamImageFilename($currentPick['team_name']); ?>" class="team-logo" alt="<?php echo htmlspecialchars($currentPick['team_name']); ?>">
                    <p><?php echo htmlspecialchars($currentPick['team_name']); ?></p>
                </div>
                <div class="card-back">
                    <h4>Record: <?php echo $currentPick['record'] ?? '--'; ?></h4>
                    <p>Opponent: <?php echo $currentPick['opponent'] ?? '--'; ?></p>
                </div>
            </div>
        </div>
    <?php else: ?>
        <p><strong>No pick has been made yet for this week.</strong></p>
    <?php endif; ?>

    <?php if (empty($currentPick)): ?>
        <form action="index.php?page=pick-team" method="POST">
            <label for="team_id">Select Team:</label>
            <select name="team_id" required>
                <option value="" disabled selected>Choose a team</option>
                <?php foreach ($teams as $team): ?>
                    <option value="<?php echo $team['id']; ?>"><?php echo htmlspecialchars($team['name']); ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit">Submit Pick</button>
        </form>
    <?php endif; ?>

    <?php
        $cutoffTimestamp = strtotime('next sunday 9pm');
        $now = time();
        $canChangePick = $now < $cutoffTimestamp;
    ?>

    <?php if (!empty($currentPick) && $canChangePick): ?>
        <h3>Change Your Pick</h3>
        <form action="index.php?page=change-pick" method="POST">
            <label for="new_team_id">Change to:</label>
            <select name="new_team_id" required>
                <option value="" disabled selected>Choose a new team</option>
                <?php foreach ($teams as $team): ?>
                    <?php if ($team['id'] !== $currentPick['team_id']): ?>
                        <option value="<?php echo $team['id']; ?>"><?php echo htmlspecialchars($team['name']); ?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>
            <button type="submit">Change Pick</button>
        </form>
    <?php elseif (!empty($currentPick)): ?>
        <p><em>You can no longer change your pick (deadline passed).</em></p>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>

