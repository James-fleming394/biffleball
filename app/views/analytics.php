<?php include 'header.php'; ?>

<style>
.analytics-section {
    margin: 2rem auto;
    max-width: 95%;
    border: 1px solid #ccc;
    border-radius: 8px;
    overflow: hidden;
    background-color: #f9f9f9;
}

.analytics-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #0074D9;
    color: white;
    padding: 1rem 1.2rem;
    font-size: 1.25rem;
    cursor: pointer;
    user-select: none;
}

.analytics-toggle-icon {
    font-weight: bold;
    font-size: 1.5rem;
}

.analytics-content {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.4s ease;
    background-color: white;
    padding: 0 1.2rem;
}

.analytics-content.active {
    padding: 1.2rem;
    max-height: 1200px;
}

.analytics-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 1rem;
}

.analytics-table th,
.analytics-table td {
    border: 1px solid #ccc;
    padding: 0.5rem;
    text-align: center;
    font-size: 0.9rem;
}

.analytics-table th {
    background-color: #0074D9;
    color: white;
    position: sticky;
    top: 0;
    z-index: 1;
}

.analytics-table tr:nth-child(even) {
    background-color: #f2f2f2;
}

.summary-row {
    font-weight: bold;
    background-color: #e3e3e3;
}
</style>

<h2 style="text-align:center; margin-top:2rem;">Advanced Analytics</h2>

<div class="analytics-section">
    <div class="analytics-header" onclick="toggleSection(this)">
        Wins Above Average (WAA)
        <span class="analytics-toggle-icon">–</span>
    </div>
    <div class="analytics-content active">
        <div style="overflow-x: auto;">
            <table class="analytics-table">
                <thead>
                    <tr>
                        <th>Username</th>
                        <?php foreach ($teams as $team): ?>
                            <th><?php echo htmlspecialchars($team['abbreviation']); ?></th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($user['username']); ?></td>
                            <?php foreach ($teams as $team): ?>
                                <td><?php echo $user['team_wins'][$team['abbreviation']] ?? 0; ?></td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                    <tr class="summary-row">
                        <td>League Avg</td>
                        <?php foreach ($teams as $team): ?>
                            <td><?php echo $leagueAverages[$team['abbreviation']] ?? 0; ?></td>
                        <?php endforeach; ?>
                    </tr>
                    <tr class="summary-row">
                        <td>Available</td>
                        <?php foreach ($teams as $team): ?>
                            <td><?php echo $availability[$team['abbreviation']] ?? 0; ?></td>
                        <?php endforeach; ?>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="analytics-section">
    <div class="analytics-header" onclick="toggleSection(this)">
        Strength of Teams Used (SOTU)
        <span class="analytics-toggle-icon">+</span>
    </div>
    <div class="analytics-content">
        <table class="analytics-table">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>SOTU (Avg. Team Wins)</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($sotuStats ?? [] as $row): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['username']); ?></td>
                        <td><?php echo $row['sotu']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="analytics-section">
    <div class="analytics-header" onclick="toggleSection(this)">
        MLB Weekly Win Totals
        <span class="analytics-toggle-icon">+</span>
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

<div class="analytics-section">
    <div class="analytics-header" onclick="toggleSection(this)">
        Weekly Pick Distribution
        <span class="analytics-toggle-icon">+</span>
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

<div class="analytics-section">
    <div class="analytics-header" onclick="toggleSection(this)">
        Teams Used by Individuals
        <span class="analytics-toggle-icon">+</span>
    </div>
    <div class="analytics-content">
        <p>Coming soon...</p>
    </div>
</div>

<script>
function toggleSection(header) {
    const content = header.nextElementSibling;
    const icon = header.querySelector('.analytics-toggle-icon');
    content.classList.toggle('active');
    icon.textContent = content.classList.contains('active') ? '–' : '+';
}
</script>

<?php include 'footer.php'; ?>