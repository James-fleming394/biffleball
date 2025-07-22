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

h2 {
    font-size: 2.2rem;
    color: #1e3d58;
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
    margin-bottom: 1rem;
}

.toggle-body.open {
    display: block;
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
    margin-bottom: 1rem;
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

#bar-chart-container {
    margin-top: 1rem;
    overflow-x: auto;
    padding-bottom: 1rem;
    position: relative;
}

.bar-chart {
    display: flex;
    align-items: flex-end;
    gap: 10px;
    height: 250px;
    border-left: 1px solid #ccc;
    border-bottom: 1px solid #ccc;
    padding-left: 10px;
}

.bar {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: flex-end;
    flex: 1; 
    max-width: 60px; 
    position: relative;
    margin: 0 2px; 
}

.bar-fill {
    width: 100%;
    height: 0; 
    border-radius: 4px 4px 0 0;
    transition: height 0.6s ease-out;
    background-color: #0074D9;
}

.bar-count {
    font-size: 0.75rem;
    font-weight: bold;
    margin-bottom: 4px;
    color: black;
}

.bar-label {
    font-size: 0.75rem;
    margin-top: 6px;
    text-align: center;
    white-space: nowrap;
}

@media (max-width: 768px) {
    .bar-chart {
        gap: 6px;
        height: 220px;
        padding-left: 5px;
    }

    .bar {
        width: 24px;
    }

    .bar-count,
    .bar-label {
        font-size: 0.65rem;
    }
}

@media (max-width: 480px) {
    .bar-chart {
        gap: 4px;
        height: 200px;
    }

    .bar {
        width: 20px;
    }

    .bar-count,
    .bar-label {
        font-size: 0.55rem;
    }
}

#bar-chart-container::after {
    content: '→ scroll';
    font-size: 0.7rem;
    color: #888;
    position: absolute;
    right: 10px;
    bottom: 5px;
    display: none;
}

@media (max-width: 768px) {
    #bar-chart-container::after {
        display: block;
    }
}


.ending {
    margin-bottom: 5rem;
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
        <label for="week_distribution">Select Week:</label>
        <select id="week_distribution">
            <?php foreach ($weeksWithPicks as $week): ?>
                <option value="<?php echo $week; ?>" <?php echo ($selectedWeek == $week) ? 'selected' : ''; ?>>
                    Week <?php echo $week; ?>
                </option>
            <?php endforeach; ?>
        </select>

        <div id="bar-chart-container"></div>
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
                <label for="mlb_week_select">Select Week:</label>
                <select id="mlb_week_select">
                    <?php for ($w = 1; $w <= 26; $w++): ?>
                        <option value="<?php echo $w; ?>" <?php echo ($selectedWeek == $w) ? 'selected' : ''; ?>>
                            Week <?php echo $w; ?>
                        </option>
                    <?php endfor; ?>
                </select>

            <div id="mlb-weekly-win-table" style="margin-top: 1rem;">
                <p>Select a week to view win totals.</p>
            </div>
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
            <table class="wide-scroll-table">
                <thead>
                    <tr>
                        <th>Username</th>
                        <?php for ($week = 1; $week <= 27; $week++): ?>
                            <th>W<?php echo $week; ?></th>
                        <?php endfor; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($teamsUsedData as $username => $picks): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($username); ?></td>
                            <?php for ($week = 1; $week <= 27; $week++): ?>
                                <td>
                                    <?php
                                    echo isset($picks[$week]) 
                                        ? htmlspecialchars($picks[$week]) 
                                        : '';
                                    ?>
                                </td>
                            <?php endfor; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        </div>
    </section>

    
    
    <div class=ending>
    </div>
</div>

<script>
let hasLoadedChart = false;

function toggleSection(header) {
    const section = header.closest('section'); // Get the full section wrapper
    const body = section.querySelector('.toggle-body');
    const icon = header.querySelector('.icon');

    const isOpen = section.classList.toggle('open'); // Toggle the section open/closed
    icon.textContent = isOpen ? '−' : '+';

    // Only animate chart if this is the Weekly Pick Distribution section
    if (isOpen && section.contains(document.getElementById('bar-chart-container'))) {
        const bars = body.querySelectorAll('.bar-fill');
        if (bars.length) {
            bars.forEach(el => el.style.height = '0px');
            setTimeout(() => {
                bars.forEach((el, i) => {
                    const h = el.getAttribute('data-height');
                    setTimeout(() => {
                        el.style.height = `${h}px`;
                    }, i * 50);
                });
            }, 50);
        }
    }
}

</script>


<script>
document.addEventListener('DOMContentLoaded', function () {
    const dropdown = document.getElementById('week_distribution');
    const container = document.getElementById('bar-chart-container');

    const teamColors = {
        BAL: '#df4601', ARI: '#a71930', LAD: '#005a9c', TOR: '#134a8e', CHW: '#27251f',
        SEA: '#0c2c56', ATL: '#ce1141', SFG: '#fd5a1e', HOU: '#002d62', MIA: '#00a3e0',
        MIN: '#002b5c', COL: '#33006f', NYY: '#003087', NYM: '#002d72', SDP: '#2f241d',
        CIN: '#c6011f', CLE: '#00385d', CHC: '#0e3386', OAK: '#003831', PHI: '#e81828',
        STL: '#c41e3a', BOS: '#bd3039', TEX: '#003278', MIL: '#12284b', DET: '#0c2340',
        KCR: '#004687', WSN: '#ab0003', LAA: '#ba0021', TBR: '#092c5c', PIT: '#000000'
    };

    const abbreviationMap = {
        "Baltimore Orioles": "BAL", "Arizona Diamondbacks": "ARI", "Los Angeles Dodgers": "LAD",
        "Toronto Blue Jays": "TOR", "Chicago White Sox": "CHW", "Seattle Mariners": "SEA",
        "Atlanta Braves": "ATL", "San Francisco Giants": "SF", "Houston Astros": "HOU",
        "Miami Marlins": "MIA", "Minnesota Twins": "MIN", "Colorado Rockies": "COL",
        "New York Yankees": "NYY", "New York Mets": "NYM", "San Diego Padres": "SD",
        "Cincinnati Reds": "CIN", "Cleveland Guardians": "CLE", "Chicago Cubs": "CHC",
        "Oakland Athletics": "OAK", "Philadelphia Phillies": "PHI", "St. Louis Cardinals": "STL",
        "Boston Red Sox": "BOS", "Tampa Bay Rays": "TB", "Texas Rangers": "TEX",
        "Los Angeles Angels": "LAA", "Pittsburgh Pirates": "PIT", "Washington Nationals": "WAS",
        "Kansas City Royals": "KC", "Milwaukee Brewers": "MIL", "Detroit Tigers": "DET"
    };

    function getColor(abbr) {
        return teamColors[abbr] || '#0074D9';
    }

    function fetchData(week) {
        fetch(`index.php?page=get-weekly-distribution&week=${week}`)
            .then(res => res.json())
            .then(data => {
                if (!data.length) {
                    container.innerHTML = '<p>No pick data available for selected week.</p>';
                    return;
                }

                let html = `<h4 style="margin-top: 1rem;">🧢 Team Picks for Week ${week}</h4>`;
                html += '<div class="bar-chart">';
                data.sort((a, b) => b.pick_count - a.pick_count);

                data.forEach(team => {
                    const abbr = team.abbreviation || abbreviationMap[team.team_name] || team.team_name;
                    const color = getColor(abbr);
                    const height = team.pick_count * 10;

                    html += `
                        <div class="bar" title="${team.team_name}">
                            <div class="bar-count">${team.pick_count}</div>
                            <div class="bar-fill" style="background-color: ${color};" data-height="${height}"></div>
                            <div class="bar-label">${abbr}</div>
                        </div>
                    `;
                });

                html += '</div>';
                container.innerHTML = html;

                // Animate bars after a short delay
                setTimeout(() => {
                    document.querySelectorAll('.bar-fill').forEach((el, i) => {
                    const finalHeight = el.getAttribute('data-height');
                setTimeout(() => {
                    el.style.height = `${finalHeight}px`;
            }, i * 50); 
            });
            }, 50);
            })
            .catch(err => {
                container.innerHTML = '<p>Error loading data.</p>';
                console.error(err);
            });
    }

    dropdown.addEventListener('change', () => {
        fetchData(dropdown.value);
    });

    fetchData(dropdown.value); // initial load

    const sectionHeader = document.querySelector('.toggle-header');
    const sectionBody = sectionHeader.nextElementSibling;
    const icon = sectionHeader.querySelector('.icon');

    sectionBody.classList.remove('open');
    icon.textContent = '+';
    });
</script>

<script>
document.getElementById('mlb_week_select').addEventListener('change', function () {
    const week = this.value;
    const container = document.getElementById('mlb-weekly-win-table');

    fetch(`index.php?page=get-weekly-win-totals&week=${week}`)
        .then(response => response.json())
        .then(data => {
            if (!data.length) {
                container.innerHTML = '<p>No data available for this week.</p>';
                return;
            }

            let html = '<table class="analytics-table">';
            html += '<thead><tr><th>Team</th><th>Wins</th></tr></thead><tbody>';
            data.forEach(row => {
                html += `<tr><td>${row.team_name}</td><td>${row.wins}</td></tr>`;
            });
            html += '</tbody></table>';

            container.innerHTML = html;
        })
        .catch(error => {
            console.error('Error fetching weekly win totals:', error);
            container.innerHTML = '<p>Error loading data.</p>';
        });
});
</script>


<?php include 'footer.php'; ?>