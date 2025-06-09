<?php include 'header.php'; ?>

<style>
.analytics-container {
    max-width: 90%;
    margin: 3rem auto;
    padding: 2rem;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
}

.analytics-container h2 {
    text-align: center;
    margin-bottom: 2rem;
    font-size: 2rem;
    color: #0074D9;
}

.analytics-container section {
    margin-bottom: 2.5rem;
    border: 3px solid #eee;
    border-radius: 8px;
    padding: 1rem;
    position: relative;
    transition: all 0.3s ease;
}

.analytics-container h3 {
    margin: 0;
    color: #333;
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 1.3rem;
    cursor: pointer;
}

.toggle-btn {
    font-size: 1.3rem;
    background: none;
    border: none;
    cursor: pointer;
    color: #0074D9;
    font-weight: bold;
    transition: transform 0.3s ease;
}

/* Animated content area */
.analytics-content {
    overflow: hidden;
    max-height: 0;
    opacity: 0;
    transition: max-height 0.5s ease, opacity 0.5s ease;
}

.analytics-content.show {
    max-height: 800px; /* large enough to contain content */
    opacity: 1;
    margin-top: 1rem;
}

.analytics-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 1rem;
}

.analytics-table th,
.analytics-table td {
    border: 1px solid #ddd;
    padding: 0.75rem;
    text-align: center;
}

.analytics-table th {
    background-color: #0074D9;
    color: white;
}

.analytics-table tr:nth-child(even) {
    background-color: #f9f9f9;
}

.analytics-container form {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 1rem;
    flex-wrap: wrap;
    margin-top: 1rem;
}

.analytics-container select,
.analytics-container button {
    padding: 0.6rem 1rem;
    font-size: 1rem;
    border-radius: 6px;
    border: 1px solid #ccc;
}

.analytics-container button {
    background-color: #0074D9;
    color: white;
    font-weight: bold;
    cursor: pointer;
    border: none;
    transition: background-color 0.3s ease;
}

.analytics-container button:hover {
    background-color: #005fa3;
}
</style>

<div class="analytics-container">
    <h2>📊 Advanced Analytics</h2>

    <section>
        <h3 onclick="toggleSection(this)">
            Wins Above Average (WAA)
            <button class="toggle-btn">−</button>
        </h3>
        <div class="analytics-content show">
            <p>Coming soon...</p>
        </div>
    </section>

    <section>
        <h3 onclick="toggleSection(this)">
            Strength of Teams Used (SOTU)
            <button class="toggle-btn">+</button>
        </h3>
        <div class="analytics-content">
            <table class="analytics-table">
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
    </section>

    <section>
        <h3 onclick="toggleSection(this)">
            MLB Weekly Win Totals
            <button class="toggle-btn">+</button>
        </h3>
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
    </section>

    <section>
        <h3 onclick="toggleSection(this)">
            Weekly Pick Distribution
            <button class="toggle-btn">+</button>
        </h3>
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
    </section>

    <section>
        <h3 onclick="toggleSection(this)">
            Teams Used by Individuals
            <button class="toggle-btn">+</button>
        </h3>
        <div class="analytics-content">
            <p>Coming soon...</p>
        </div>
    </section>
</div>

<script>
function toggleSection(header) {
    const content = header.nextElementSibling;
    const button = header.querySelector('.toggle-btn');
    const isVisible = content.classList.contains('show');

    if (isVisible) {
        content.classList.remove('show');
        button.textContent = "+";
    } else {
        content.classList.add('show');
        button.textContent = "−";
    }
}
</script>

<?php include 'footer.php'; ?>