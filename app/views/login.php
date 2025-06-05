<?php include 'header.php'; ?>



<div class="login-wrapper">
    <div class="login-box">
        <h2>Login</h2>

        <?php if (isset($_GET['session_expired'])): ?>
            <p style="color: red;">Your session has expired due to inactivity. Please log in again.</p>
        <?php endif; ?>

        <form action="index.php?page=login" method="POST">
            <input type="email" name="email" placeholder="Email" required>
            <div class="password-wrapper">
                <input type="password" name="password" placeholder="Password" id="login-password" required>
                <i class="fas fa-eye toggle-password" id="toggleLoginPassword"></i>
            </div>
            <button type="submit">Login</button>
        </form>
    </div>
    <div class="logo-box">
        <img src="/images/BiffleballSmallLogo.png" alt="BiffleBall Logo">
    </div>
</div>

<?php include 'footer.php'; ?>