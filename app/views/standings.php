<?php include 'header.php'; ?>

<h2>Standings</h2>

<table border="1">
    <tr>
        <th>Rank</th>
        <th>Player</th>
        <th>Wins</th>
    </tr>
    <?php $rank = 1; ?>
    <?php foreach ($rankings as $player): ?>
        <tr>
            <td><?php echo $rank++; ?></td>
            <td><?php echo $player['username']; ?></td>
            <td><?php echo $player['wins']; ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<?php include 'footer.php'; ?>
