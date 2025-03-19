<?php include 'header.php'; ?>

<h2>Login</h2>

<?php if (isset($_GET['session_expired'])): ?>
    <p style="color: red;">Your session has expired due to inactivity. Please log in again.</p>
<?php endif; ?>

<form action="index.php?page=login" method="POST">
    <input type="email" name="email" placeholder="Email" required><br><br>
    <input type="password" name="password" placeholder="Password" required><br><br>
    <button type="submit">Login</button>
</form>

<?php include 'footer.php'; ?>

