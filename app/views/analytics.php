<?php include 'header.php'; ?>

<style>
.analytics-section {
    border: 1px solid #ddd;
    border-radius: 8px;
    margin: 1rem auto;
    padding: 0;
    max-width: 1200px;
    background: #fff;
    box-shadow: 0 4px 12px rgba(0,0,0,0.06);
    overflow: hidden;
}

.analytics-header {
    background-color: #0074D9;
    color: #fff;
    padding: 1rem;
    font-size: 1.2rem;
    font-weight: bold;
    cursor: pointer;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.analytics-content {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.4s ease, padding 0.4s ease;
    padding: 0 1rem;
}

.analytics-content.expanded {
    padding: 1rem;
    max-height: 2000px;
}

.toggle-icon {
    font-size: 1.2rem;
    font-weight: bold;
}

.waa-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.9rem;
}

.waa-table th,
.waa-table td {
    border: 1px solid #ddd;
    padding: 6px;
    text-align: center;
}

.waa-table th {
    background-color: #f2f2f2;
    position: sticky;
    top: 0;
    z-index: 1;
}
.waa-table tfoot {
    font-weight: bold;
    background-color: #f9f9f9;
}
</style>

<h2 style="text-align:center;">📊 Advanced Analytics</h2>

<!-- WAA Section -->
<div class="analytics-section">
    <div class="analytics-header" onclick="toggleSection(this)">
        Wins Above Average (WAA)
        <span class="toggle-icon">−</span>
    </div>
    <div class="analytics-content expanded">
        <div style="overflow-x: auto;">
            <table class="waa-table">
                <thead>
                    <tr>
                        <th>Username</th>
                        <?php foreach ($teams as $team): ?>
                            <th><?php echo htmlspecialchars($team['name']); ?></th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($waaStats as $row): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['username']); ?></td>
                            <?php foreach ($teams as $team): ?>
                                <td><?php echo $row['team_wins'][$team['name']] ?? 0; ?></td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td>League Avg. With Team</td>
                        <?php foreach ($teams as $team): ?>
                            <td><?php echo number_format($leagueAverages[$team['name']] ?? 0, 2); ?></td>
                        <?php endforeach; ?>
                    </tr>
                    <tr>
                        <td>Users With Team Available</td>
                        <?php foreach ($teams as $team): ?>
                            <td><?php echo $usersAvailable[$team['name']] ?? 0; ?></td>
                        <?php endforeach; ?>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<!-- SOTU Section -->
<div class="analytics-section">
    <div class="analytics-header" onclick="toggleSection(this)">
        Strength of Teams Used (SOTU)
        <span class="toggle-icon">+</span>
    </div>
    <div class="analytics-content">
        <table class="waa-table">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>SOTU (Avg. Team Wins)</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($sotuStats as $row): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['username']); ?></td>
                        <td><?php echo $row['sotu']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- MLB Weekly Win Totals -->
<div class="analytics-section">
    <div class="analytics-header" onclick="toggleSection(this)">
        MLB Weekly Win Totals
        <span class="toggle-icon">+</span>
    </div>
    <div class="analytics-content">
        <form method="GET" action="">
            <label for="week">Select Week:</label>
            <select name="week" id="week">
                <?php for ($w = 1; $w <= 26; $w++): ?>
                    <option value="<?php echo $w; ?>">Week <?php echo $w; ?></option>
                <?php endfor; ?>
            </select>
            <button type="submit">View</button>
        </form>
    </div>
</div>

<!-- Weekly Pick Distribution -->
<div class="analytics-section">
    <div class="analytics-header" onclick="toggleSection(this)">
        Weekly Pick Distribution
        <span class="toggle-icon">+</span>
    </div>
    <div class="analytics-content">
        <form method="GET" action="">
            <label for="week_distribution">Select Week:</label>
            <select name="week_distribution" id="week_distribution">
                <?php for ($w = 1; $w <= 26; $w++): ?>
                    <option value="<?php echo $w; ?>">Week <?php echo $w; ?></option>
                <?php endfor; ?>
            </select>
            <button type="submit">View</button>
        </form>
    </div>
</div>

<!-- Teams Used by Individuals -->
<div class="analytics-section">
    <div class="analytics-header" onclick="toggleSection(this)">
        Teams Used by Individuals
        <span class="toggle-icon">+</span>
    </div>
    <div class="analytics-content">
        <p>Coming soon.</p>
    </div>
</div>

<script>
function toggleSection(header) {
    const content = header.nextElementSibling;
    const icon = header.querySelector('.toggle-icon');

    if (content.classList.contains('expanded')) {
        content.classList.remove('expanded');
        icon.textContent = '+';
    } else {
        document.querySelectorAll('.analytics-content').forEach(c => c.classList.remove('expanded'));
        document.querySelectorAll('.toggle-icon').forEach(i => i.textContent = '+');
        content.classList.add('expanded');
        icon.textContent = '−';
    }
}
</script>

<?php include 'footer.php'; ?>