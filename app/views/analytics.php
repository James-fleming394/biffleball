<?php include 'header.php'; ?>

<h2>Advanced Analytics</h2>

<section>
    <h3>Wins Above Average (WAA)</h3>
    
</section>

<section>
    <h3>Wins Above Average* (WAA*)</h3>
    
</section>

<section>
    <h3>Strength of Teams Used (SOTU)</h3>
    <table border="1" cellpadding="8" cellspacing="0" style="margin: auto;">
        <tr>
            <th>Username</th>
            <th>SOTU (Avg. Team Wins)</th>
        </tr>
        <?php foreach ($sotuStats as $row): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['username']); ?></td>
                <td><?php echo $row['sotu']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</section>

<section>
    <h3>MLB Weekly Win Totals</h3>
    <form method="GET" action="">
        <label for="week">Select Week:</label>
        <select name="week" id="week">
            <?php for ($w = 1; $w <= 26; $w++): ?>
                <option value="<?php echo $w; ?>">Week <?php echo $w; ?></option>
            <?php endfor; ?>
        </select>
        <button type="submit">View</button>
    </form>
    
</section>

<section>
    <h3>Weekly Pick Distribution</h3>
    <form method="GET" action="">
        <label for="week_distribution">Select Week:</label>
        <select name="week_distribution" id="week_distribution">
            <?php for ($w = 1; $w <= 26; $w++): ?>
                <option value="<?php echo $w; ?>">Week <?php echo $w; ?></option>
            <?php endfor; ?>
        </select>
        <button type="submit">View</button>
    </form>
    
</section>

<section>
    <h3>Teams Used by Individuals</h3>

</section>

<?php include 'footer.php'; ?>