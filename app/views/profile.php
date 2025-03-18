<?php include 'header.php'; ?>

<h2>My Profile</h2>

<p><strong>Username:</strong> <?php echo $user['username']; ?></p>
<p><strong>Email:</strong> <?php echo $user['email']; ?></p>

<h3>My Picks</h3>
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

<a href="index.php?page=pick-team">Make a Pick</a>

<?php include 'footer.php'; ?>
