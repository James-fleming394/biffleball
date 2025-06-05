<?php include 'header.php'; ?>

<div class="register-page">
    <div class="register-logo">
        <img src="/images/BiffleballSmallLogo.png" alt="BiffleBall Logo">
    </div>

    <div class="register-box">
        <h2>Create Your Account</h2>
        <form action="index.php?page=register" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" id="password" placeholder="Password" required>
            
            <label>
                <input type="checkbox" id="togglePassword" style="margin-right: 6px;"> Show Password
            </label>
            
            <button type="submit">Register</button>
        </form>
    </div>
</div>

<?php include 'footer.php'; ?>
