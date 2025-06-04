<?php include 'header.php'; ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
    /* Hero Section */
    #hero {
        padding: 4rem 1rem 2rem; 
        overflow: hidden;
        position: relative;
        z-index: 10;
    }

    #hero .cs-container {
        width: 100%;
        max-width: 80rem;
        margin: auto;
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
        gap: 3rem;
        flex-wrap: wrap;
        padding: 0 1rem;
    }

    #hero .cs-content {
        text-align: left;
        width: 100%;
        max-width: 39.375rem;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        position: relative;
        z-index: 10;
    }

    #hero .cs-title {
        font-size: clamp(2.4375rem, 6.4vw, 3.8125rem);
        font-weight: 900;
        text-transform: uppercase;
        line-height: 1.2em;
        margin: 0 0 1rem;
        color: white;
    }

    #hero .cs-text {
        font-size: clamp(1rem, 2.5vw, 1.25rem);
        line-height: 1.5em;
        max-width: 43.75rem;
        margin: 0 0 clamp(1.75rem, 4vw, 2.5rem);
        color: white;
        opacity: 0.9;
    }

    #hero .cs-button-solid {
        font-size: 1rem;
        line-height: clamp(2.875rem, 5.5vw, 3.5rem);
        font-weight: 700;
        color: #fff;
        padding: 0 1.75rem;
        background-color: #0074D9;
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        position: relative;
        z-index: 1;
        transition: background 0.3s ease;
        text-decoration: none;
        border-radius: 8px;
    }

    #hero .cs-button-solid:hover {
        background-color: #005fa3;
    }

    #hero .cs-button-arrow {
        width: 20px;
        height: 20px;
    }

    #hero .cs-picture {
        width: 100%;
        max-width: clamp(26rem, 50vw, 36rem);
        display: flex;
        align-items: flex-end;
        z-index: 7;
    }

    #hero .cs-picture img {
        width: 100%;
        height: auto;
        margin-bottom: -32px;   
    }

    #hero .cs-image-group {
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
        overflow: hidden;
        z-index: 1;
    }

    #hero .cs-background {
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
    }

    #hero .cs-background img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        filter: brightness(0.4);
    }

    /* About Section */
    .button-group {
        margin-top: 30px;
    }

    a.button {
        display: inline-block;
        padding: 12px 25px;
        background-color: #005fa3;
        color: white;
        text-decoration: none;
        border-radius: 25px;
        font-weight: bold;
        margin: 10px;
        transition: background 0.3s ease;
    }

    a.button:hover {
        background-color:rgb(96, 169, 221);
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

    .welcome-back h3 {
        font-size: 1.5em;
        margin-bottom: 20px;
        color: #0074D9;
    }

    .social-section h3 {
        font-size: 1.5em;
        margin-top: 40px;
        margin-bottom: 20px;
        color: #0074D9;
    }
    
    .button-group,
    .welcome-back,
    .social-section {
        text-align: center;
        width: 100%;
    }

</style>

<section id="hero">
    <div class="cs-container">
        <div class="cs-content">
            <h1 class="cs-title">BiffleBall</h1>
            <p class="cs-text">The First Baseball Survivor Pool</p>
            <a href="index.php?page=register" class="cs-button-solid">
                Get Started Today
                <img class="cs-button-arrow" src="https://csimg.nyc3.cdn.digitaloceanspaces.com/Images/Icons/white-arrow-up.svg" alt="arrow" />
            </a>
        </div>
        <picture class="cs-picture">
            <img src="https://pngimg.com/d/baseball_PNG19028.png" alt="Baseball Icon">
        </picture>
    </div>
    <div class="cs-image-group">
        <picture class="cs-background">
            <img src="https://media.istockphoto.com/id/520876362/photo/baseball-stadium.jpg?s=612x612&w=0&k=20&c=BULB5RCcGEV0_Ho6CFX8VksLep_OhC6YwKYRdgt2rYc=" alt="Baseball Stadium">
        </picture>
    </div>
</section>

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
        <div class="welcome-back">
            <h3>Welcome Back <?= isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : '' ?>!</h3>
            <a class="button" href="index.php?page=standings">View Standings</a>
            <a class="button" href="index.php?page=analytics">Analytics</a>
            <a class="button" href="index.php?page=profile">My Profile</a>
            <a class="button" href="index.php?page=picks">Submit Pick</a>
        </div>
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
</div>


<?php include 'footer.php'; ?>
