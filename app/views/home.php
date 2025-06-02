<?php include 'header.php'; ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
    .hero {
        background: url('https://t4.ftcdn.net/jpg/11/86/21/57/360_F_1186215713_JUdn1YV0E3kRruukuvi3EQ3D8Cg2qKIz.jpg') center/cover no-repeat;
        padding: 100px 20px;
        color: white;
        text-align: center;
        box-shadow: inset 0 0 0 2000px rgba(0, 0, 0, 0.5);
    }

    .hero h1 {
        font-size: 3em;
        margin-bottom: 10px;
        letter-spacing: 2px;
    }

    .hero p {
        font-size: 1.2em;
        max-width: 600px;
        margin: 0 auto;
    }

    .container {
        max-width: 900px;
        margin: 40px auto;
        background: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        text-align: center;
    }

    ul {
        text-align: left;
        padding-left: 20px;
        max-width: 600px;
        margin: 0 auto;
        margin-top: 20px;
    }

    .button-group {
        margin-top: 30px;
    }

    a.button {
        display: inline-block;
        padding: 12px 25px;
        background:rgb(114, 176, 218);
        color: white;
        text-decoration: none;
        border-radius: 25px;
        font-weight: bold;
        margin: 10px;
        transition: background 0.3s ease;
    }

    a.button:hover {
        background: #e69500;
    }

    .about-section {
        max-width: 1100px;
        margin: 60px auto;
        padding: 20px;
        text-align: center;
    }

    .about-section h2 {
        font-size: 2.5em;
        margin-bottom: 30px;
    }

    .about-boxes {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: center;
    }

    .about-box {
        flex: 1 1 30%;
        background: #fff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        cursor: pointer;
        min-width: 250px;
    }

    .about-box:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 20px rgba(0, 0, 0, 0.2);
        background-color: #f9f9f9;
    }

    .about-box h3 {
        color: #0074D9;
        margin-bottom: 15px;
    }

    .about-box p {
        font-size: 0.95em;
        line-height: 1.6;
    }

    @media (max-width: 768px) {
        .about-boxes {
            flex-direction: column;
        }
    }

    @media (max-width: 768px) {
        .hero h1 {
            font-size: 2em;
        }

        .container {
            margin: 20px;
        }
    }
    .socials-section {
        margin-top: 40px;
        text-align: center;
    }

    .socials-section h3 {
        font-size: 1.5em;
        margin-bottom: 20px;
    }

    .social-icons {
        display: flex;
        justify-content: center;
        gap: 30px;
    }

    .social-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        font-size: 28px;
        color: white;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .x-link {
        background-color: #1DA1F2;
    }

    .x-link:hover {
        background-color: #0d8ae8;
        transform: scale(1.1);
    }

    .discord-link {
        background-color: #5865F2;
    }

    .discord-link:hover {
        background-color: #404EED;
        transform: scale(1.1);
    }
</style>
<div class="hero">
    <h1 class= "title">BiffleBall</h1>
    <p>The First Baseball Survivor Pool</p>
    <p>Engage with MLB like never before. Pick a team each week, track your wins, and compete for the BiffleBall Belt!</p>
</div>

    <div class="about-section">
    <h2>About BiffleBall</h2>
    <div class="about-boxes">
        <div class="about-box">
            <h3>What is BiffleBall?</h3>
            <p>BiffleBall is a Survivor-Pool style competition for MLB fans. With 162 games, it’s easy to lose interest — BiffleBall keeps fans engaged all season long by creating a weekly rooting interest no matter your favorite team’s record.</p>
        </div>

        <div class="about-box">
            <h3>How Do I Play?</h3>
            <p>Pick one MLB team each week (Mon–Sun). Earn 1 point for each win your team gets. You can’t pick the same team twice. Most total wins at season’s end wins the prestigious BiffleBall Belt.</p>
        </div>

        <div class="about-box">
            <h3>Strategy</h3>
            <p>Choose teams with 7-game weeks? Go with Vegas favorites? Ride a hot streak or avoid bad weather? There’s no single path to victory. Plan wisely and outlast the rest.</p>
        </div>
    </div>
    </div>
    <div class="button-group">
    <?php if (!isset($_SESSION['user_id'])): ?>
        <a class="button" href="index.php?page=register">Register Now</a>
        <a class="button" href="index.php?page=login">Log In</a>
    <?php else: ?>
        <h3>
            Welcome Back 
            <?= isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : '' ?>!
        </h3>
        <a class="button" href="index.php?page=standings">View Standings</a>
        <a class="button" href="index.php?page=analytics">Analytics</a>
        <a class="button" href="index.php?page=profile">My Profile</a>
        <a class="button" href="index.php?page=picks">Submit Pick</a>
    <?php endif; ?>
</div>

    <div class="social-section">
        <h3>Socials</h3>
        <div class="social-icons">
        <a href="https://x.com/Biffle_Ball" target="_blank" class="social-icon x-link" title="Follow us on X">
            <i class="fab fa-x-twitter"></i>
        </a>
        <a href="https://discord.gg/FF4Y7KxT" target="_blank" class="social-icon discord-link" title="Join our Discord">
            <i class="fab fa-discord"></i>
        </a>
    </div>

<?php include 'footer.php'; ?>
