<?php include 'header.php'; ?>

<style>
.pick-container {
    max-width: 900px;
    margin: 3rem auto;
    text-align: center;
}

.countdown {
    font-size: 1.25rem;
    color: #0074D9;
    margin-bottom: 2rem;
}

.card-wrapper {
    perspective: 1000px;
    margin: 2rem auto;
    width: 260px;
    height: 350px;
}

.card {
    position: relative;
    width: 100%;
    height: 100%;
    border-radius: 12px;
    transition: transform 0.8s;
    transform-style: preserve-3d;
}

.card:hover {
    transform: rotateY(180deg);
}

.card-front, .card-back {
    position: absolute;
    width: 100%;
    height: 100%;
    backface-visibility: hidden;
    background: white;
    border-radius: 12px;
    box-shadow: 0 8px 16px rgba(0,0,0,0.2);
    padding: 1rem;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.card-front {
    border: 5px solid #0074D9;
}

.card-back {
    transform: rotateY(180deg);
    background-color: #f7f7f7;
}

.card img.team-logo {
    width: 120px;
    height: auto;
    margin: 1rem 0;
}

.pennant {
    position: absolute;
    top: 0.5rem;
    right: 0.5rem;
    background: #0074D9;
    color: white;
    font-size: 0.75rem;
    font-weight: bold;
    padding: 0.3rem 0.6rem;
    clip-path: polygon(0 0, 100% 0, 100% 70%, 80% 100%, 0 100%);
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
</style>

<div class="pick-container">
    <h2>🏟️ Pick Your Team for This Week 🏟️</h2>

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
        `⏳ Picks Locked in: ${hours}h ${minutes}m ${seconds}s ⏳`;
}

setInterval(updateCountdown, 1000);
updateCountdown();
</script>

<?php
// Helpers to determine team image and color
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
    return $colors[$lastWord] ?? '#0074D9'; // default blue fallback
}

?>

<?php include 'footer.php'; ?>


