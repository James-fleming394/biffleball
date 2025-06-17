<?php include 'header.php'; ?>

<style>
.analytics-container {
    max-width: 90%;
    margin: 2rem auto;
    padding: 1rem;
}

section {
    margin-bottom: 2rem;
    border: 1px solid #ccc;
    border-radius: 8px;
    overflow: hidden;
}

.toggle-header {
    background-color: #0074D9;
    color: white;
    padding: 0.8rem 1rem;
    font-size: 1.2rem;
    font-weight: bold;
    cursor: pointer;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.scroll-table-wrapper {
    max-height: 400px;
    overflow-y: auto;
    overflow-x: auto;
    border: 1px solid #ccc;
    border-radius: 6px;
    margin-top: 1rem;
}

/* Sticky headers */
.scroll-table-wrapper table thead th {
    position: sticky;
    top: 0;
    background-color: #f4f4f4;
    z-index: 2;
}

/* Ensure min-width for horizontal scrolling */
.scroll-table-wrapper table {
    min-width: 800px;
}

.toggle-header .icon {
    font-weight: bold;
    font-size: 1.5rem;
}

.toggle-body {
    padding: 1rem;
    display: none;
    animation: fadeIn 0.4s ease-in-out;
}

section.open .toggle-body {
    display: block;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-8px); }
    to { opacity: 1; transform: translateY(0); }
}

table {
    border-collapse: collapse;
    width: 100%;
    margin-top: 1rem;
}

th, td {
    border: 1px solid #ccc;
    padding: 6px;
    text-align: center;
    font-size: 0.85rem;
}

th {
    background-color: #f4f4f4;
    font-weight: bold;
}

.bar-chart {
    display: flex;
    align-items: flex-end;
    height: 200px;
    gap: 8px;
    margin-top: 1rem;
    border-left: 1px solid #ccc;
    border-bottom: 1px solid #ccc;
    padding-left: 10px;
}

.bar {
    width: 30px;
    background-color: #0074D9;
    color: white;
    text-align: center;
    font-size: 0.75rem;
    border-radius: 4px 4px 0 0;
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
}

.bar-label {
    writing-mode: vertical-rl;
    transform: rotate(180deg);
    margin-top: 4px;
}
</style>

<h2 style="text-align:center; margin-top:2rem;">📊 Advanced Analytics</h2>

<div class="analytics-container">

    <!-- WAA -->
    <section class="open">
    <div class="toggle-header" onclick="toggleSection(this)">
        Wins Above Average (WAA)
        <span class="icon">−</span>
    </div>
    <div class="toggle-body">
        <div class="scroll-table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Username</th>
                    <?php foreach ($teams as $team): ?>
                        <th><?php echo htmlspecialchars($team['abbreviation']); ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($waaStats['users'] as $username => $teamData): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($username); ?></td>
                        <?php foreach ($teams as $team): ?>
                            <td><?php echo $teamData[$team['abbreviation']] ?? 0; ?></td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>

                <!-- League Average Row -->
                <tr>
                    <td><strong>League Avg</strong></td>
                    <?php foreach ($teams as $team): ?>
                        <td><?php echo number_format($waaStats['leagueAverage'][$team['abbreviation']] ?? 0, 2); ?></td>
                    <?php endforeach; ?>
                </tr>

                <!-- Availability Row -->
                <tr>
                    <td><strong>Users w/ Team Available</strong></td>
                    <?php foreach ($teams as $team): ?>
                        <td><?php echo $waaStats['usersWithTeamAvailable'][$team['abbreviation']] ?? 0; ?></td>
                    <?php endforeach; ?>
                </tr>
            </tbody>
        </table>
        </div>
    </div>
</section>

    <!-- SOTU -->
    <section>
    <div class="toggle-header" onclick="toggleSection(this)">
        SOTU 
        <span class="icon">+</span>
    </div>
    <div class="toggle-body">
        <div class="scroll-table-wrapper">
        <div style="overflow-x: auto;">
            <table>
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>SOTU (Strength of Teams Used)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($sotuStats as $row): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['username']); ?></td>
                            <td><?php echo number_format($row['sotu'], 2); ?>%</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        </div>
    </div>
    </section>

    <!-- Weekly Pick Distribution -->
    <section>
        <div class="toggle-header" onclick="toggleSection(this)">
            Weekly Pick Distribution
            <span class="icon">+</span>
        </div>
        <div class="toggle-body">
            <form method="GET" action="">
                <label for="week_distribution">Select Week:</label>
                <select name="week_distribution" id="week_distribution" onchange="this.form.submit()">
                    <?php for ($w = 1; $w <= 26; $w++): ?>
                        <option value="<?php echo $w; ?>" <?php echo (isset($_GET['week_distribution']) && $_GET['week_distribution'] == $w) ? 'selected' : ''; ?>>
                            Week <?php echo $w; ?>
                        </option>
                    <?php endfor; ?>
                </select>
            </form>

            <?php if (!empty($distributionData)): ?>
                <div class="bar-chart">
                    <?php foreach ($distributionData as $team => $count): ?>
                        <div class="bar" style="height: <?php echo $count * 20; ?>px;">
                            <div><?php echo $count; ?></div>
                            <div class="bar-label"><?php echo htmlspecialchars($team); ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p>No pick data available for selected week.</p>
            <?php endif; ?>
        </div>
    </section>

    <!-- MLB Weekly Win Totals -->
    <section>
        <div class="toggle-header" onclick="toggleSection(this)">
            MLB Weekly Win Totals
            <span class="icon">+</span>
        </div>
        <div class="toggle-body">
            <div class="scroll-table-wrapper">
            <form method="GET" action="">
                <label for="week">Select Week:</label>
                <select name="week" id="week">
                    <?php for ($w = 1; $w <= 26; $w++): ?>
                        <option value="<?php echo $w; ?>">Week <?php echo $w; ?></option>
                    <?php endfor; ?>
                </select>
                <button type="submit">View</button>
            </form>
            <p>Coming soon...</p>
            </div>
        </div>
    </section>

    <!-- Teams Used by Individuals -->
    <section>
        <div class="toggle-header" onclick="toggleSection(this)">
            Teams Used by Individuals
            <span class="icon">+</span>
        </div>
        <div class="toggle-body">
            <div class="scroll-table-wrapper">
            <p>Coming soon...</p>
            </div>
        </div>
    </section>
</div>

<script>
function toggleSection(headerEl) {
    const section = headerEl.parentElement;
    const isOpen = section.classList.contains('open');
    section.classList.toggle('open');
    headerEl.querySelector('.icon').textContent = isOpen ? '+' : '−';
}
</script>

<?php include 'footer.php'; ?>