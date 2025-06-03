<!DOCTYPE html>
<html>
<head>
    <title>Biffleball</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body { margin: 0; font-family: Arial, sans-serif; }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #0074D9;
            padding: 10px 20px;
            height: 60px;
            overflow: hidden;
        }

        .logo-container {
            height: 200px;
            display: flex;
            align-items: center;
        }

        .logo-container img {
            height: 200px;
            margin-bottom: 25px;
            transform: scale(0.6); 
            transform-origin: left center;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            font-weight: bold;
            transition: opacity 0.3s;
        }

        .nav-links a:hover {
            opacity: 0.8;
        }
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
    </div>
</nav>
