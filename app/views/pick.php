<?php include 'header.php'; ?>

<h2>Pick Your Team for This Week</h2>

<form action="index.php?page=pick-team" method="POST">
    <label for="team_id">Select Team:</label>
    <select name="team_id" required>
        <?php foreach ($teams as $team): ?>
            <option value="<?php echo $team['id']; ?>"><?php echo $team['name']; ?></option>
        <?php endforeach; ?>
    </select>
    <button type="submit">Submit Pick</button>
</form>

<h3>Your Past Picks</h3>
<table border="1">
    <tr>
        <th>Week</th>
        <th>Team</th>
    </tr>
    <?php foreach ($picks as $pick): ?>
        <tr>
            <td><?php echo $pick['week']; ?></td>
            <td><?php echo $pick['team_name']; ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<?php include 'footer.php'; ?>
