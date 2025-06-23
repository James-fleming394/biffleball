<?php include 'header.php'; ?>
<?php
$nextWeek = $nextWeek ?? ((int)date('W') + 1);
$canPickNextWeek = $canPickNextWeek ?? false;
?>


<style>
body{
    background: linear-gradient(to bottom right, #f0f8ff,rgb(136, 179, 245));
}

.pick-container {
    max-width: 1100px;
    margin: 3rem auto;
    text-align: center;
}

.pick-container h2 {
    font-size: 2.2rem;
    color: #1e3d58;
    margin-bottom: 2rem;
}

.countdown {
    font-size: 1.25rem;
    color: rgb(255, 0, 0);
    margin-bottom: 2rem;
    font-weight: bold;
}

.card-wrapper {
    perspective: 1000px;
    margin: 1rem auto;
    width: 260px;
    height: 360px;
    margin-bottom: 5rem;
}

.card {
    position: relative;
    width: 100%;
    height: 100%;
    border-radius: 12px;
    transition: transform 0.8s;
    transform-style: preserve-3d;
    margin-left: 7%;
}

.card-and-schedule {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    align-items: flex-start;
    gap: 2rem;
    margin-top: 1rem;
}

.team-schedule {
    flex: 1 1 220px;
    background: #f9f9f9;
    border-radius: 8px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.08);
    text-align: left;
    min-width: 200px;
    padding: 2.5%;
    margin: 2.5%;
}

.schedule-list {
    list-style: none;
    padding: 3%;
    margin: 3%;
}

.schedule-list li {
    padding: 0.3rem 0;
    border-bottom: 1px solid #ddd;
    font-size: 0.95rem;
}

.card:hover {
    transform: rotateY(180deg);
}

.card-front, .card-back {
    position: absolute;
    padding: 1rem;
    width: 100%;
    height: 100%;
    backface-visibility: hidden;
    background: white;
    border-radius: 12px;
    box-shadow: 0 8px 16px rgba(0,0,0,0.2);
    overflow: hidden;
}

.card-front {
    border: 5px solid #0074D9;
}

.card-back {
    transform: rotateY(180deg);
    background-color: #f7f7f7;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

/* Week label */
.week-label {
    position: absolute;
    top: 0.4rem;
    left: 0.6rem;
    background-color: rgb(38, 39, 41);
    color: white;
    font-size: 1rem;
    font-weight: bold;
    padding: 0.3rem 0.6rem;
    border-radius: 6px;
    z-index: 2;
}

/* Pennant image */
.pennant-img {
    position: absolute;
    top: 0.5rem;
    right: 0.5rem;
    transform: translateX(-10px) rotate(10deg);
    width: 80px;
    height: auto;
    z-index: 2;
}

/* Team name above logo box */
.team-name-header {
    margin-top: 3rem;
    font-size: 1.2rem;
    font-weight: bold;
    color: #333;
}

/* Logo container */
.logo-box {
    margin-top: 1.5rem;
    padding: 1rem;
    border: 2px solid #ddd;
    border-radius: 10px;
    background: rgba(0, 0, 0, 0.05);
}

.card img.team-logo {
    width: 120px;
    height: 160px;
}

/* Team name box at bottom */
.team-name-box {
    background-color: #0074D9;
    color: white;
    font-size: 1.1rem;
    padding: 0.6rem;
    width: 100%;
    text-align: center;
    font-weight: bold;
    position: absolute;
    bottom: 0;
    left: 0;
    border-top: 2px solid white;
}

/* MLB logo */
.card .mlb-logo {
    position: absolute;
    bottom: 8px;
    right: 8px;
    width: 40px;
    height: auto;
    opacity: 0.9;
    z-index: 1;
}

form {
    margin-bottom: 2rem;
}

select, button {
    padding: 0.75rem;
    font-size: 1rem;
    margin: 0.5rem;
    border-radius: 6px;
}

button {
    background-color: #0074D9;
    color: white;
    border: none;
    cursor: pointer;
}

button:hover {
    background-color: #005fa3;
}

/* Calendar section */
.schedule-placeholder {
    margin-top: 1rem;
    font-size: 0.9rem;
    color: #333;
    text-align: center;
}

.league-division {
    position: absolute;
    bottom: 8px;
    left: 10px;
    font-size: 1rem;
    font-weight: bold;
    color: #444;
    background: rgba(0, 0, 0, 0.05);
    padding: 2px 6px;
    border-radius: 4px;
}

.pick-sections {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 2rem;
    margin-top: 2rem;
}

.current-pick-section,
.upcoming-pick-section {
    flex: 1 1 45%;
    min-width: 320px;
    border: 2px solid #ccc;
    border-radius: 12px;
    padding: 1.5rem;
    background-color: #fff;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.06);
}

.modal {
    display: none;
    position: fixed;
    z-index: 9999;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.6);
}

.modal-content {
    background-color: #fff;
    margin: 20% auto;
    padding: 2rem;
    border-radius: 10px;
    width: 80%;
    max-width: 400px;
    text-align: center;
    font-size: 1.2rem;
    color: #0074D9;
}

.modal-schedule {
    display: none;
    position: fixed;
    z-index: 9998;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.6);
}

.modal-schedule-content {
    background-color: #fff;
    margin: 5% auto;
    padding: 2rem;
    border-radius: 10px;
    width: 90%;
    max-width: 600px;
    max-height: 80%;
    overflow-y: auto;
    position: relative;
}

.close-schedule-popup {
    position: absolute;
    top: 10px;
    right: 16px;
    font-size: 1.5rem;
    color: #888;
    cursor: pointer;
}

#schedulePopupContent table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 1rem;
}

#schedulePopupContent th, #schedulePopupContent td {
    border: 1px solid #ddd;
    padding: 0.75rem;
    text-align: left;
}

#schedulePopupContent th {
    background-color: #f4f4f4;
}

</style>

<div class="pick-container">
    <h2>🏟️ Biffleball Weekly Picks 🏟️</h2>

<div class="pick-sections">
    <!-- CURRENT WEEK PICK SECTION -->
<div class="current-pick-section">
    <h3>Week <?php echo $currentPick['week']; ?> — Locked Pick</h3>

    <?php if (!empty($currentPick)): ?>
        <div class="card-and-schedule">
            <!-- Card -->
            <div class="card-wrapper">
                <div class="card">
                    <div class="card-front" style="border-color: <?php echo getTeamColor($currentPick['team_name']); ?>">
                        <div class="week-label">Week <?php echo $currentPick['week']; ?></div>
                        <img src="/images/BiffleballPennant.png" alt="Biffleball Pennant" class="pennant-img">
                        <div class="team-name-header"><?php echo htmlspecialchars($currentPick['team_name']); ?></div>
                        <div class="logo-box">
                            <img src="/images/logos/<?php echo getTeamImageFilename($currentPick['team_name']); ?>" class="team-logo" alt="<?php echo htmlspecialchars($currentPick['team_name']); ?>">
                        </div>
                        <?php $div = getTeamDivisionInfo($currentPick['team_name']); ?>
                        <div class="league-division"><?php echo $div['league'] . ' ' . $div['division']; ?></div>
                        <img src="/images/mlblogo.png" class="mlb-logo" alt="MLB Logo">
                    </div>
                    <div class="card-back">
                        <h3>Current Pick</h3>
                        <img src="/images/logos/<?php echo getTeamImageFilename($currentPick['team_name']); ?>" class="team-logo" alt="<?php echo htmlspecialchars($currentPick['team_name']); ?>">
                        <p><?php echo htmlspecialchars($currentPick['team_name']); ?></p>
                        <h4>Record: <?php echo $currentPick['record'] ?? '--'; ?></h4>
                        <p><strong>Last 10 Games:</strong> 7–3</p>
                        <p>
                            📅 <strong><a href="#" class="open-schedule-popup" data-team="<?php echo htmlspecialchars($currentPick['team_name']); ?>">Schedule</a></strong>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Schedule -->
            <div class="team-schedule">
                <h4>📅 <?php echo htmlspecialchars($currentPick['team_name']); ?> Schedule: Week  <?php echo $currentPick['week']; ?></h4>
                <ul class="schedule-list">
                    <li>Mon: vs TBD</li>
                    <li>Tue: at TBD</li>
                    <li>Wed: —</li>
                    <li>Thu: vs TBD</li>
                    <li>Fri: at TBD</li>
                    <li>Sat: at TBD</li>
                    <li>Sun: vs TBD</li>
                </ul>
            </div>
        </div>
    <?php else: ?>
        <p><strong>No pick has been made yet for this week.</strong></p>
    <?php endif; ?>
</div>

    <!-- UPCOMING WEEK PICK SECTION -->
    <div class="upcoming-pick-section">
        <h3>Week <?php echo $nextWeek; ?> — Upcoming Pick</h3>

        <div class="countdown" id="countdown"></div>

        <?php if (empty($nextPick) && $canPickNextWeek): ?>
            <form action="index.php?page=pick-team" method="POST" class="pick-form">
                <label for="team_id">Select Team:</label>
                <select name="team_id" required>
                    <option value="" disabled selected>Choose a team</option>
                    <?php foreach ($teams as $team): ?>
                        <option value="<?php echo $team['id']; ?>"><?php echo htmlspecialchars($team['name']); ?></option>
                    <?php endforeach; ?>
                </select>
                <button type="submit">Submit Pick</button>
            </form>
        <?php elseif (!empty($nextPick) && $canPickNextWeek): ?>
            <h4>Your current pick: <?php echo htmlspecialchars($nextPick['team_name']); ?></h4>
            <form action="index.php?page=change-pick" method="POST" class="pick-form">
                <label for="new_team_id">Change to:</label>
                <select name="new_team_id" required>
                    <option value="" disabled selected>Choose a new team</option>
                    <?php foreach ($teams as $team): ?>
                        <?php if ($team['id'] !== $nextPick['team_id']): ?>
                            <option value="<?php echo $team['id']; ?>"><?php echo htmlspecialchars($team['name']); ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
                <button type="submit">Change Pick</button>
            </form>
        <?php elseif (!$canPickNextWeek): ?>
            <p><strong>Picks Locked for Week <?php echo $nextWeek; ?> ⛔</strong></p>
        <?php endif; ?>
    </div>
</div>

</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const popup = document.getElementById('schedulePopup');
    const closeBtn = document.querySelector('.close-schedule-popup');

    document.querySelectorAll('.open-schedule-popup').forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            const teamName = e.target.dataset.team;
            document.getElementById('schedulePopupTitle').textContent = `${teamName} - Full Season Schedule`;
            popup.style.display = 'block';
        });
    });

    closeBtn.addEventListener('click', () => {
        popup.style.display = 'none';
    });

    window.addEventListener('click', (e) => {
        if (e.target === popup) {
            popup.style.display = 'none';
        }
    });
});
</script>


<script>
// Countdown to Sunday 9PM EST
function updateCountdown() {
    const now = new Date();
    let sunday = new Date();
    sunday.setDate(now.getDate() + (7 - now.getDay()) % 7);
    sunday.setHours(21, 0, 0, 0);

    const diff = sunday - now;
    const hours = Math.floor(diff / (1000 * 60 * 60));
    const minutes = Math.floor((diff / (1000 * 60)) % 60);
    const seconds = Math.floor((diff / 1000) % 60);

    document.getElementById("countdown").textContent =
        `⏳ Picks Lock In: ${hours}h ${minutes}m ${seconds}s ⏳`;
}
setInterval(updateCountdown, 1000);
updateCountdown();

// Modal confirmation logic
function showSubmissionModalAndSubmit(form) {
    const modal = document.getElementById('submissionModal');
    modal.style.display = 'block';

    setTimeout(() => {
        form.submit();
    }, 1500); // Delay before actual form submission
}

document.addEventListener('DOMContentLoaded', () => {
    const forms = document.querySelectorAll('.pick-form');

    forms.forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            showSubmissionModalAndSubmit(this);
        });
    });
});
</script>

<?php
// Helpers
function getTeamImageFilename($teamName) {
    return strtolower(str_replace(' ', '', explode(' ', $teamName)[count(explode(' ', $teamName))-1])) . ".png";
}

function getTeamColor($teamName) {
    $colors = [
        'Angels' => '#BA0021',
        'Astros' => '#002D62',
        'Athletics' => '#003831',
        'Blue Jays' => '#134A8E',
        'Braves' => '#CE1141',
        'Brewers' => '#12284B',
        'Cardinals' => '#C41E3A',
        'Cubs' => '#0E3386',
        'Diamondbacks' => '#A71930',
        'Dodgers' => '#005A9C',
        'Giants' => '#FD5A1E',
        'Guardians' => '#0F223E',
        'Mariners' => '#0C2C56',
        'Marlins' => '#00A3E0',
        'Mets' => '#002D72',
        'Nationals' => '#AB0003',
        'Orioles' => '#DF4601',
        'Padres' => '#2F241D',
        'Phillies' => '#E81828',
        'Pirates' => '#FDB827',
        'Rangers' => '#003278',
        'Rays' => '#092C5C',
        'Red Sox' => '#BD3039',
        'Reds' => '#C6011F',
        'Rockies' => '#333366',
        'Royals' => '#004687',
        'Tigers' => '#0C2340',
        'Twins' => '#002B5C',
        'White Sox' => '#27251F',
        'Yankees' => '#132448',
    ];
    $parts = explode(' ', $teamName);
    $lastWord = end($parts);
    return $colors[$lastWord] ?? '#0074D9';
}

function getTeamDivisionInfo($teamName) {
    $divisions = [
        'Yankees' => ['league' => 'AL', 'division' => 'East'],
        'Red Sox' => ['league' => 'AL', 'division' => 'East'],
        'Blue Jays' => ['league' => 'AL', 'division' => 'East'],
        'Rays' => ['league' => 'AL', 'division' => 'East'],
        'Orioles' => ['league' => 'AL', 'division' => 'East'],

        'White Sox' => ['league' => 'AL', 'division' => 'Central'],
        'Guardians' => ['league' => 'AL', 'division' => 'Central'],
        'Tigers' => ['league' => 'AL', 'division' => 'Central'],
        'Royals' => ['league' => 'AL', 'division' => 'Central'],
        'Twins' => ['league' => 'AL', 'division' => 'Central'],

        'Astros' => ['league' => 'AL', 'division' => 'West'],
        'Rangers' => ['league' => 'AL', 'division' => 'West'],
        'Angels' => ['league' => 'AL', 'division' => 'West'],
        'Mariners' => ['league' => 'AL', 'division' => 'West'],
        'Athletics' => ['league' => 'AL', 'division' => 'West'],

        'Braves' => ['league' => 'NL', 'division' => 'East'],
        'Phillies' => ['league' => 'NL', 'division' => 'East'],
        'Mets' => ['league' => 'NL', 'division' => 'East'],
        'Marlins' => ['league' => 'NL', 'division' => 'East'],
        'Nationals' => ['league' => 'NL', 'division' => 'East'],

        'Cardinals' => ['league' => 'NL', 'division' => 'Central'],
        'Cubs' => ['league' => 'NL', 'division' => 'Central'],
        'Brewers' => ['league' => 'NL', 'division' => 'Central'],
        'Reds' => ['league' => 'NL', 'division' => 'Central'],
        'Pirates' => ['league' => 'NL', 'division' => 'Central'],

        'Dodgers' => ['league' => 'NL', 'division' => 'West'],
        'Padres' => ['league' => 'NL', 'division' => 'West'],
        'Giants' => ['league' => 'NL', 'division' => 'West'],
        'Diamondbacks' => ['league' => 'NL', 'division' => 'West'],
        'Rockies' => ['league' => 'NL', 'division' => 'West'],
    ];

    $parts = explode(' ', $teamName);
    $lastWord = end($parts);

    return $divisions[$lastWord] ?? ['league' => '—', 'division' => '—'];
}
?>
<!-- Submission Modal -->
<div id="submissionModal" class="modal">
    <div class="modal-content">
        <p>Your pick has been submitted! 🎉</p>
    </div>
</div>

<!-- Schedule Modal -->
<div id="schedulePopup" class="modal-schedule">
    <div class="modal-schedule-content">
        <span class="close-schedule-popup">&times;</span>
        <h3 id="schedulePopupTitle">Full Season Schedule</h3>
        <div id="schedulePopupContent">
            <table>
                <thead>
                    <tr><th>Date</th><th>Opponent</th><th>Time</th></tr>
                </thead>
                <tbody>
                    <tr><td>Mar 28</td><td>@ Yankees</td><td>7:05 PM</td></tr>
                    <tr><td>Mar 29</td><td>@ Yankees</td><td>1:10 PM</td></tr>
                    <tr><td>Apr 1</td><td>vs Red Sox</td><td>6:40 PM</td></tr>
                    <!-- Add or load more rows -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>