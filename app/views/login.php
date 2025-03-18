<?php include 'header.php'; ?>

<h2>Login</h2>

<form action="index.php?page=login" method="POST">
    <input type="email" name="email" placeholder="Email" required><br><br>
    <input type="password" name="password" placeholder="Password" required><br><br>
    <button type="submit">Login</button>
</form>

<?php include 'footer.php'; ?>
