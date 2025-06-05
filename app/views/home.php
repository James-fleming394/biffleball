<?php include 'header.php'; ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
    /* Hero Section */
    #hero {
        padding: 7rem 1rem 2rem;
        overflow: hidden;
        position: relative;
        background-color: #000;
        z-index: 1;
    }

    #hero .cs-container {
        max-width: 80rem;
        margin: auto;
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
        gap: 3rem;
        flex-wrap: wrap;
        padding: 0 1rem;
        position: relative;
        z-index: 2;
    }

    #hero .cs-content {
        text-align: left;
        width: 100%;
        max-width: 39.375rem;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }

    #hero .cs-title {
        font-size: clamp(2.4375rem, 6.4vw, 3.8125rem);
        font-weight: 900;
        text-transform: uppercase;
        line-height: 1.2em;
        margin-bottom: 1rem;
        color: white;
    }

    #hero .cs-text {
        font-size: clamp(1rem, 2.5vw, 1.25rem);
        line-height: 1.5em;
        margin-bottom: clamp(1.75rem, 4vw, 2.5rem);
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
        border-radius: 8px;
        text-decoration: none;
        transition: background 0.3s ease;
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
        justify-content: center;
        position: relative;
        height: 300px;
        transform: translateX(-10%); 
    }

    #hero .cs-picture img {
        position: relative;
        bottom: 0;
        width: 100%;
        height: auto;
        opacity: 0;
        transition: opacity 1s ease-in-out;
    }

    #hero .cs-picture img.active {
        opacity: 1;
        z-index: 3;
    }

    #hero .cs-image-group {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 0;
    }

    #hero .cs-background img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        filter: brightness(0.4);
    }

    /* How it Works Section */
    .how-it-works {
        padding: 20px 20px;
        padding-bottom: 60px;
        background-color: #f4f4f4;
        text-align: center;
    }

    .how-it-works h2 {
        font-size: 2.5em;
        margin-bottom: 40px;
        color: #0074D9;
        text-transform: uppercase;
    }

    .steps {
        display: flex;
        justify-content: center;
        gap: 40px;
        flex-wrap: wrap;
    }

    .step {
        background: white;
        padding: 30px;
        border-radius: 10px;
        width: 280px;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }

    .step:hover {
        transform: translateY(-10px);
        cursor: pointer;
    }

    .step .icon {
        font-size: 3em;
        margin-bottom: 20px;
    }

    .step h3 {
        font-size: 1.25em;
        color: #0074D9;
        margin-bottom: 10px;
    }

    .step p {
        font-size: 0.95em;
        line-height: 1.5;
    }

    .button-group {
        margin-top: 30px;
    }

    .button {
        display: inline-block;
        padding: 10px 20px;
        background-color: #0074D9;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        font-size: 1.2em;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }
    .button:hover {
        background-color: #005fa3;
        transform: scale(1.05);
    }

    .welcome-back {
        margin-top: 20px;
        text-align: center;
    }
    .welcome-back h3 {
        font-size: 1.5em;
        margin-bottom: 20px;
        color: #0074D9;
    }

    .socials-section {
        margin-top: 40px;
        text-align: center;
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
    <div class="cs-image-group">
        <picture class="cs-background">
            <img src="https://media.istockphoto.com/id/520876362/photo/baseball-stadium.jpg?s=612x612&w=0&k=20&c=BULB5RCcGEV0_Ho6CFX8VksLep_OhC6YwKYRdgt2rYc=" alt="Baseball Stadium Background">
        </picture>
    </div>
    <div class="cs-container">
        <div class="cs-content">
            <h1 class="cs-title">BiffleBall</h1>
            <p class="cs-text">The First Baseball Survivor Pool</p>
            <a href="index.php?page=register" class="cs-button-solid">
                Get Started Today
                <img class="cs-button-arrow" src="https://csimg.nyc3.cdn.digitaloceanspaces.com/Images/Icons/white-arrow-up.svg" alt="arrow" />
            </a>
        </div>
        <div class="cs-picture">
            <img src="https://pngimg.com/uploads/baseball/small/baseball_PNG19054.png" class="active" alt="Ball 1">
            <img src="https://pngimg.com/uploads/baseball/small/baseball_PNG19000.png" alt="Ball 2">
            <img src="https://pngimg.com/uploads/baseball/small/baseball_PNG19001.png" alt="Ball 3">
        </div>
    </div>
</section>

<script>
    const imgs = document.querySelectorAll(".cs-picture img");
    let current = 0;
    setInterval(() => {
        imgs[current].classList.remove("active");
        current = (current + 1) % imgs.length;
        imgs[current].classList.add("active");
    }, 4000);
</script>

<section class="how-it-works">
    <h2>Get in the Game</h2>
    <div class="steps">
        <div class="step">
            <div class="icon">🧢</div>
            <h3>Pick a Team Each Week</h3>
            <p>Choose one MLB team to ride with from Monday to Sunday. Just don’t pick the same team twice!</p>
        </div>
        <div class="step">
            <div class="icon">✅</div>
            <h3>Get 1 Point Per Win</h3>
            <p>Every win that week earns you a point. Easy to track, fun to follow.</p>
        </div>
        <div class="step">
            <div class="icon">🏆</div>
            <h3>Win the Season</h3>
            <p>Rack up the most points and win bragging rights—and the BiffleBall Belt.</p>
        </div>
    </div>
</section>

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