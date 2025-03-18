<?php include 'header.php'; ?>

<h2>Register</h2>

<form action="index.php?page=register" method="POST">
    <input type="text" name="username" placeholder="Username" required><br><br>
    <input type="email" name="email" placeholder="Email" required><br><br>
    <input type="password" name="password" placeholder="Password" required><br><br>
    <button type="submit">Register</button>
</form>

<?php include 'footer.php'; ?>
