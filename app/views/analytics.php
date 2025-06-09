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
    margin-bottom: 3rem;
}

.analytics-container h3 {
    margin-bottom: 1rem;
    color: #333;
    border-bottom: 2px solid #0074D9;
    padding-bottom: 0.3rem;
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
        <h3>Wins Above Average (WAA)</h3>
        <p>Coming soon...</p>
    </section>

    <section>
        <h3>Wins Above Average* (WAA*)</h3>
        <p>Coming soon...</p>
    </section>

    <section>
        <h3>Strength of Teams Used (SOTU)</h3>
        <table class="analytics-table">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>SOTU</th>
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
        <p>Coming soon...</p>
    </section>
</div>

<?php include 'footer.php'; ?>
