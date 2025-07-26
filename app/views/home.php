<?php include 'header.php'; ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
    /* Hero Section */
    #hero {
        padding: 4rem 1rem 2rem;
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
        margin-bottom: 2rem;
        margin-top: -2rem;
    }

    #hero .cs-title {
        font-size: clamp(2.4375rem, 6.4vw, 3.8125rem);
        font-weight: 900;
        text-transform: uppercase;
        line-height: 1.2em;
        margin-bottom: 1rem;
        color: white;
        animation: fadeIn 1.2s ease forwards;
    }

    #hero .highlight {
        background: linear-gradient(90deg,rgb(255, 255, 255) 0%,rgb(255, 255, 255) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        display: inline-block;
        animation: slideIn 1s ease-out;
    }

    #hero .cs-text {
        font-size: clamp(1.5rem, 2.5vw, 1.25rem);
        line-height: 1.5em;
        margin-bottom: clamp(1.75rem, 4vw, 2.5rem);
        color: white;
        opacity: 0.9;
        margin-left: 0.25rem;
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

    #hero .cs-picture img:first-child {
        transition-delay: 0.2s; /* same as .cs-title */
    }


    #hero .cs-background img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        filter: brightness(0.4);
    }

    /* Initial hidden/offset state */
    #hero .cs-title,
    #hero .cs-text,
    #hero .cs-button-solid {
        opacity: 0;
        transform: translateY(20px);
        }

    /* Animated state (triggered via JS) */
    #hero .cs-title.animate-in,
    #hero .cs-text.animate-in,
    #hero .cs-button-solid.animate-in {
        opacity: 1;
        transform: translateY(0);
        transition: all 0.8s ease;
    }

    /* Optional stagger effect */
    #hero .cs-title.animate-in {
        transition-delay: 0.2s;
    }

    #hero .cs-text.animate-in {
        transition-delay: 0.5s;
    }

    #hero .cs-button-solid.animate-in {
        transition-delay: 0.8s;
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

    /* Leaderboard Section */
    .leaderboard {
        display: flex;
        flex-wrap: wrap;
        align-items: flex-start;
        justify-content: center;
        gap: 3rem;
        max-width: 1100px;
        margin: 80px auto;
        padding: 0 20px;
    }

    .leaderboard-column {   
        flex: 1 1 45%;
        background-color: #f5f5f5;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
    }

    .leaderboard-column h2 {
        font-size: 1.8rem;
        margin-bottom: 20px;
        color: #0074D9;
    }

    .leaderboard-table {    
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .leaderboard-row {
        display: flex;
        justify-content: space-between;
        font-size: 1.1rem;
        padding: 8px 12px;
        border-bottom: 1px solid #ddd;
    }

    .leaderboard-row.header {
        font-weight: bold;
        color: #555;
        border-bottom: 2px solid #0074D9;
    }

    .leaderboard-cta {
        display: inline-block;
        margin-top: 20px;
        padding: 10px 20px;
        background-color: #0074D9;
        color: white;
        border-radius: 25px;
        text-decoration: none;
        font-weight: bold;
        transition: background 0.3s ease;
    }

    .leaderboard-cta:hover {
        background-color: #005fa3;
    }

    /* Responsive layout for smaller screens */
    @media (max-width: 768px) {
        .newsletter-leaderboard {
            flex-direction: column;
        }

        .newsletter-column,
        .leaderboard-column {
            flex: 1 1 100%;
        }
    }

    .secondary-cta {
        display: inline-block;
        margin-top: 15px;
        padding: 10px 20px;
        background-color: #fddb3a;
        color: #000;
        border-radius: 25px;
        font-weight: 600;
        text-decoration: none;
        transition: background 0.3s ease;
    }

    .secondary-cta:hover {
        background-color: #e6c72e;
    }

    .weekly-recap {
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid #ccc;
    }

    .weekly-recap h4 {
        font-size: 1.2em;
        margin-bottom: 15px;
        color: #0074D9;
    }

    .bar-chart {
        display: flex;
        flex-direction: column;
        gap: 10px;
        margin-top: 1rem;
        width: 100%;
    }

    .bar {
        display: flex;
        align-items: center;
        gap: 10px;
        overflow: hidden;
    }

    .bar-left {
        display: flex;
        align-items: center;
        flex: 1;
        min-width: 0; /* Prevents overflow */
    }

    .bar .label {
        width: 80px;
        font-weight: 600;
        font-size: 0.95em;
        white-space: nowrap;
    }

    .team-logo {
        width: 24px;
        height: 24px;
        object-fit: contain;
        margin-right: 6px;
    }

    .bar-fill {
        height: 24px;
        background-color: #0074D9;
        color: white;
        font-size: 0.85em;
        line-height: 24px;
        text-align: right;
        padding-right: 8px;
        border-radius: 4px;
        width: 0;
        overflow: hidden;
        transition: width 1s ease-out;
        white-space: nowrap;
    }


    .bar .bar-fill.low {
        background-color: #d94e4e;
    }

    /* Belt Testimonials Section */
    .belt-testimonials {
        background: #f5f7fa;
        padding: 60px 20px;
    }

    .belt-testimonials-container {
        max-width: 1100px;
        margin: auto;
        display: flex;
        gap: 40px;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: center;
    }

    .testimonials-box {
        flex: 1;
        max-width: 500px;
    }

    .testimonials-box h3 {
        margin-bottom: 20px;
        font-size: 1.75em;
        color: #0074D9;
    }

    .testimonial-slide {
        opacity: 0;
        transform: translateX(40px);
        transition: opacity 0.5s ease, transform 0.5s ease;
        position: absolute;
        width: 100%;
        top: 0;
        left: 0;
    }

    .testimonial-slide.active {
        opacity: 1;
        transform: translateX(0);
        position: relative;
    }

    .testimonial-slide span {
        display: block;
        margin-top: 10px;
        font-weight: bold;
        color: #333;
    } 

    .belt-box {
        flex: 1;
        text-align: center;
    }

    .belt-box img {
        max-width: 60%;
    }

    .belt-box h3 {
        font-size: 1.8em;
        margin-bottom: 10px;
    }

    .belt-box p {
        font-size: 1.1em;
        margin-bottom: 20px;
    }

    @media (max-width: 768px) {
    .belt-testimonials-container {
        flex-direction: column;
        align-items: center;
    }

    .belt-box,
    .testimonials-box {
        max-width: 100%;
        text-align: center;
    }
}

    /* Newsletter Section */
    .newsletter-section {
        text-align: center;
        padding: 60px 20px;
        background-color: #f2f2f2;
    }

    .newsletter-btn {
        padding: 15px 30px;
        font-size: 1.1rem;
        background-color: #0074D9;
        color: white;
        border: none;
        border-radius: 30px;
        cursor: pointer;
        transition: background 0.3s ease;
    }

    .newsletter-btn:hover {
        background-color: #005fa3;
    }

    .newsletter-modal {
        display: none;
        position: fixed;
        top: 0; left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.7);
        justify-content: center;
        align-items: center;
        z-index: 9999;
    }

    .newsletter-modal.active {
        display: flex;
    }

    .newsletter-content {
        background: white;
        padding: 30px;
        border-radius: 10px;
        max-width: 700px;
        width: 90%;
        max-height: 90vh;
        overflow-y: auto;
        position: relative;
        box-shadow: 0 0 20px rgba(0,0,0,0.2);
    }

    .newsletter-content img {
        width: 100%;
        height: auto;
        margin-top: 20px;
    }

    .close-btn {
        position: absolute;
        top: 10px; right: 15px;
        font-size: 1.5rem;
        cursor: pointer;
    }


    /* Social Section */
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
            <h1 class="cs-title">
                <span class="highlight">BiffleBall</span>
            </h1>
            <p class="cs-text">One Win at a Time</p>
            <a href="index.php?page=register" class="cs-button-solid">
                Get Started Today
            <img class="cs-button-arrow" src="https://csimg.nyc3.cdn.digitaloceanspaces.com/Images/Icons/white-arrow-up.svg" alt="arrow" />
            </a>
        </div>
        <div class="cs-picture">
            <img src="https://pngimg.com/uploads/baseball/small/baseball_PNG19054.png" alt="Ball 1">
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
    }, 8000);

    document.addEventListener("DOMContentLoaded", () => {
    const title = document.querySelector("#hero .cs-title");
    const text = document.querySelector("#hero .cs-text");
    const button = document.querySelector("#hero .cs-button-solid");
    const firstImg = document.querySelector(".cs-picture img");

    // Staggered content
    setTimeout(() => title.classList.add("animate-in"), 100);
    setTimeout(() => text.classList.add("animate-in"), 400);
    setTimeout(() => button.classList.add("animate-in"), 700);
    setTimeout(() => firstImg.classList.add("active"), 200); // Fade in image
    });

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

<section class="leaderboard">
    <div class="leaderboard-column">
        <h2>🔥 Top Players This Week</h2>
        <div class="leaderboard-table">
            <div class="leaderboard-row header">
                <span>Rank</span>
                <span>Username</span>
                <span>Wins</span>
            </div>
            <div class="leaderboard-row">
                <span>🥇</span>
                <span>MLBKing42</span>
                <span>8</span>
            </div>
            <div class="leaderboard-row">
                <span>🥈</span>
                <span>ClutchCall</span>
                <span>7</span>
            </div>
            <div class="leaderboard-row">
                <span>🥉</span>
                <span>FastballFan</span>
                <span>7</span>
            </div>
        </div>
        <a class="button leaderboard-cta" href="index.php?page=register">Think you can beat them? →</a>

        <a class="button secondary-cta" href="index.php?page=standings">See Full Standings →</a>

<div class="weekly-recap">
    <h4>This Week's Picks</h4>
    <div class="bar-chart">
        <?php foreach ($topPicks as $team): ?>
            <?php
                $teamName = $team['team_name'] ?? '';
                $percentage = $team['percentage'] ?? 0;
                $customFilenames = [
                    'red sox' => 'redsox.png',
                    'white sox' => 'whitesox.png',
                    'blue jays' => 'bluejays.png',
                    'a\'s' => 'athletics.png'
                ];
                $key = strtolower($teamName);
                if (isset($customFilenames[$key])) {
                    $filename = $customFilenames[$key];
                } else {
                    $parts = explode(' ', strtolower($teamName));
                    $filename = end($parts) . '.png';
                }
                $logoPath = "/images/logos/$filename";
            ?>
            <div class="bar">
            <div class="bar-left">
                <img class="team-logo" src="<?php echo $logoPath; ?>" alt="<?php echo htmlspecialchars($teamName); ?> logo">
                <span class="label"><?php echo htmlspecialchars($teamName); ?></span>
            </div>
            <div class="bar-fill<?php echo ((int)$percentage < 5 ? ' low' : ''); ?>" data-width="<?php echo (int)$percentage; ?>%">
            <?php echo (int)$percentage; ?>%
            </div>
        </div>

        <?php endforeach; ?>
    </div>
</div>

</section>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const bars = document.querySelectorAll('.bar');

    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const bar = entry.target;
                const fill = bar.querySelector('.bar-fill');
                const targetWidth = fill.getAttribute('data-width');

                if (targetWidth) {
                    fill.style.width = targetWidth;
                }

                observer.unobserve(bar);
            }
        });
    }, {
        threshold: 0.3
    });

    bars.forEach(bar => observer.observe(bar));
});
</script>



<section class="belt-testimonials">
    <div class="belt-testimonials-container">

    <!-- Left: Testimonials -->
    <div class="testimonials-box">
        <h3>🏟️ What Players Are Saying</h3>
        <div class="testimonial-slide active">
            <p>"BiffleBall makes the regular season fun again. I check the scores every night!"</p>
            <span>- @DiamondDave</span>
        </div>
        <div class="testimonial-slide">
            <p>"I’ve never cared more about a Tuesday game in June… I love it."</p>
            <span>- @PickMaster7</span>
        </div>
        <div class="testimonial-slide">
            <p>"Made it to the top 10 last season. This year, I’m coming for the belt."</p>
            <span>- @SleeperPick</span>
        </div>
    </div>

    <!-- Right: Belt Promo -->
    <div class="belt-box">
        <img src="/images/belt-promo.png" alt="BiffleBall Championship Belt" class="belt-image">
            <h3>🏆 Win the Belt</h3>
            <p>One champion. One belt. All glory.</p>
        <a class="button leaderboard-cta" href="index.php?page=register">Start Your Run →</a>
    </div>

    </div>
</section>

<script>
    let currentSlide = 0;
    const slides = document.querySelectorAll('.testimonial-slide');

    function showNextSlide() {
        slides[currentSlide].classList.remove('active');
        currentSlide = (currentSlide + 1) % slides.length;
        slides[currentSlide].classList.add('active');
    }

    // Start by activating the first slide
    slides[currentSlide].classList.add('active');

    setInterval(showNextSlide, 5000);
</script>

<section class="newsletter-section">
    <h2>📰 This Week’s Newsletter</h2>
    <button class="newsletter-btn" onclick="toggleNewsletter(true)">View Newsletter</button>

    <div id="newsletter-modal" class="newsletter-modal" onclick="toggleNewsletter(false)">
        <div class="newsletter-content" onclick="event.stopPropagation()">
        <span class="close-btn" onclick="toggleNewsletter(false)">✖</span>
        <img src="https://media.discordapp.net/attachments/1090992614116954263/1397958190565560391/S5-All-Star-Break-Odds.jpg?ex=68864085&is=6884ef05&hm=8a224f428aaba1132804b315503e9d2406285fac683b2cfcc3bd280b378ce7d2&=&format=webp&width=458&height=648" alt="Weekly Newsletter" />
        </div>
    </div>
</section>

<script>
    function toggleNewsletter(show) {
        const modal = document.getElementById('newsletter-modal');
        if (show) {
            modal.classList.add('active');
        } else {
            modal.classList.remove('active');
        }
    }
</script>



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