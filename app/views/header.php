<!DOCTYPE html>
<html>
<head>
    <title>Biffleball</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Montserrat', sans-serif;
        }

        nav {
            position: sticky;
            top: 0;
            z-index: 1000;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #0074D9;
            padding: 10px 20px;
            height: 60px;
            overflow: hidden;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
        }

        .logo-container {
            height: 200px;
            display: flex;
            align-items: center;
        }

        .logo-container img {
            height: 250px;
            margin-bottom: 30px;
            transform: scale(0.6);
            transform-origin: left center;
            filter: brightness(0) invert(1);
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 30px;
            position: relative;
        }

        .nav-links a {
            position: relative;
            color: #f6f4e6;
            text-decoration: none;
            font-size: 1.1em;
            text-transform: uppercase;
            font-weight: 500;
            transition: all 0.2s ease-in-out;
        }

        .nav-links a:hover {
            color: #fddb3a;
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 100%;
            height: 2px;
            background: #ffffff;
            transform: scaleX(0);
            transform-origin: center;
            transition: transform 0.3s ease;
        }

.nav-links a:hover::after {
    transform: scaleX(1);
}

        .nav-links a:nth-child(1):hover ~ .dot { transform: translateX(0); opacity: 1; }
        .nav-links a:nth-child(2):hover ~ .dot { transform: translateX(100px); opacity: 1; }
        .nav-links a:nth-child(3):hover ~ .dot { transform: translateX(200px); opacity: 1; }
        .nav-links a:nth-child(4):hover ~ .dot { transform: translateX(300px); opacity: 1; }
        .nav-links a:nth-child(5):hover ~ .dot { transform: translateX(400px); opacity: 1; }
        .nav-links a:nth-child(6):hover ~ .dot { transform: translateX(500px); opacity: 1; }
        .nav-links a:nth-child(7):hover ~ .dot { transform: translateX(600px); opacity: 1; }
        .nav-links a:nth-child(8):hover ~ .dot { transform: translateX(700px); opacity: 1; }

    </style>
</head>
<body>

<nav>
    <div class="logo-container">
        <a href="index.php">
            <img src="/images/Biffleball.png" alt="BiffleBall Logo">
        </a>
    </div>
    <div class="nav-links">
        <a href="index.php">Home</a>
        <a href="index.php?page=standings">Standings</a>
        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="index.php?page=pick-team">Submit Pick</a>
            <a href="index.php?page=analytics">Analytics</a>
            <a href="index.php?page=profile">My Profile</a>
            <a href="index.php?page=logout">Logout</a>
        <?php else: ?>
            <a href="index.php?page=login">Login</a>
            <a href="index.php?page=register">Register</a>
        <?php endif; ?>
        <span class="dot"></span>
    </div>
</nav>
