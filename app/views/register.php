<?php include 'header.php'; ?>

<div class="register-page">
    <div class="register-left">
        <img src="/images/biffleball-logo.png" alt="BiffleBall Logo" class="register-logo">
        <div class="social-icons">
            <a href="https://x.com/Biffle_Ball" target="_blank" title="Follow us on X">
                <i class="fab fa-x-twitter"></i>
            </a>
            <a href="https://discord.gg/FF4Y7KxT" target="_blank" title="Join us on Discord">
                <i class="fab fa-discord"></i>
            </a>
        </div>
    </div>

    <div class="register-right">
        <h2>Create Your Account</h2>

        <!-- Success or error messages -->
        <?php if (isset($_GET['success'])): ?>
            <div class="message success">Registration successful! You can now log in.</div>
        <?php elseif (isset($_GET['error']) && $_GET['error'] === 'email'): ?>
            <div class="message error">That email is already in use. Please try again.</div>
        <?php endif; ?>

        <form action="index.php?page=register" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <div class="password-wrapper">
                <input type="password" name="password" id="reg-password" placeholder="Password" required>
                <i class="fas fa-eye toggle-icon" id="togglePassword"></i>
            </div>
            <button type="submit" class="register-btn">Register</button>
        </form>
    </div>
</div>

<?php include 'footer.php'; ?>
