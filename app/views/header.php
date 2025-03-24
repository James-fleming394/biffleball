<!DOCTYPE html>
<html>
<head>
    <title>Biffleball</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; }
        nav { background: #0074D9; padding: 10px; }
        nav a { color: white; margin: 10px; text-decoration: none; }
    </style>
</head>
<body>

<nav>
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
</nav>
