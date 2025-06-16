<?php include 'header.php'; ?>

<style>
.login-wrapper {
    display: flex;
    align-items: stretch;
    justify-content: center;
    min-height: 100vh;
    padding: 2rem 4rem;
    gap: 2rem;
    background: linear-gradient(135deg, rgb(27, 19, 183), rgb(110, 174, 246));
    background-color: rgb(27, 19, 183);
    margin-bottom: -5%;
}

.login-box,
.logo-box {
    flex: 1 1 400px;
    background-color: #fff;
    border-radius: 12px;
    padding: 2rem;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    max-height: 500px;
    max-width: 600px;
    overflow: hidden;
    position: relative;
}

.logo-box {
    align-items: center;
    text-align: center;
    position: relative;
}

.logo-box img {
    max-width: 80%;
    height: auto;
    margin-top: 2rem;
    margin-bottom: auto;
}

.login-box h2 {
    font-size: 3rem;
    color: #0074D9;
    margin-bottom: 1rem;
}

form {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

form input,
form button {
    width: 100%;
    padding: 0.75rem 1rem;
    margin-bottom: 1rem;
    font-size: 1rem;
    border: 1px solid #ccc;
    border-radius: 6px;
    box-sizing: border-box;
}

input[type="text"],
input[type="email"],
input[type="password"] {
    padding: 12px 16px;
    font-size: 1rem;
    border: 1px solid #ccc;
    border-radius: 6px;
    width: 100%;
}

.password-wrapper {
    position: relative;
    width: 100%;
}

.password-wrapper input {
    width: 100%;
    padding: 0.75rem 1rem;
    padding-right: 2.75rem;
    font-size: 1rem;
    border: 1px solid #ccc;
    border-radius: 6px;
    box-sizing: border-box;
}

.password-wrapper .toggle-password {
    position: absolute;
    top: 40%;
    right: 0.75rem;
    transform: translateY(-50%);
    cursor: pointer;
    font-size: 1.2rem;
    color: #888;
}

button[type="submit"] {
    padding: 12px 20px;
    font-size: 1rem;
    font-weight: bold;
    background-color: #0074D9;
    color: white;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: background 0.3s ease;
}

button[type="submit"]:hover {
    background-color: #005fa3;
}

.forgot-password {
    margin-top: 0.5rem;
    text-align: right;
}

.forgot-password a {
    font-size: 0.9rem;
    color: #0074D9;
    text-decoration: none;
}

.forgot-password a:hover {
    text-decoration: underline;
    color: #005fa3;
}


@media (max-width: 768px) {
    .login-wrapper {
        flex-direction: column;
        align-items: center;
    }

    .login-box,
    .logo-box {
        width: 100%;
    }
}
</style>

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
        <div class="forgot-password">
            <a href="index.php?page=forgot-password">Forgot password?</a>
        </div>
    </div>

    <div class="logo-box">
        <img src="/images/BiffleballSmallLogo.png" alt="BiffleBall Logo">
    </div>
</div>

<?php include 'footer.php'; ?>