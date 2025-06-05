<?php include 'header.php'; ?>

<style>
.register-wrapper {
    display: flex;
    align-items: stretch;
    justify-content: center;
    min-height: 100vh;
    padding: 2rem;
    gap: 2rem;
    background-color:rgb(27, 19, 183);
}

.register-box,
.logo-box {
    flex: 1 1 400px;
    background-color: #fff;
    border-radius: 12px;
    padding: 2rem;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    max-height: 600px;
    overflow: hidden;
    position: relative;
    transition: transform 0.3s ease;
}

.logo-box {
    align-items: center;
    text-align: center;
    position: relative;
}

.logo-box img {
    max-width: 200px;
    height: auto;
    margin-top: 2rem;
    margin-bottom: auto;
}

.socials {
    display: flex;
    justify-content: center;
    gap: 20px;
    margin-top: auto;
    padding-top: 2rem;
}

.socials a {
    font-size: 24px;
    color: #0074D9;
    transition: transform 0.3s ease;
}

.socials a:hover {
    transform: scale(1.1);
}

.register-box h2 {
    font-size: 2rem;
    color: #0074D9;
    margin-bottom: 1rem;
}

form {
    display: flex;
    flex-direction: column;
    gap: 1rem;
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
}

.password-wrapper input {
    padding-right: 40px;
}

.password-toggle {
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
    color: #555;
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

@media (max-width: 768px) {
    .register-wrapper {
        flex-direction: column;
        align-items: center;
    }

    .register-box,
    .logo-box {
        width: 100%;
    }
}
</style>

<div class="register-wrapper">
    <div class="logo-box">
        <img src="/images/BiffleballSmallLogo.png" alt="BiffleBall Logo">
        <div class="socials">
            <a href="https://x.com/Biffle_Ball" target="_blank"><i class="fab fa-x-twitter"></i></a>
            <a href="https://discord.gg/FF4Y7KxT" target="_blank"><i class="fab fa-discord"></i></a>
        </div>
    </div>

    <div class="register-box">
        <h2>Register</h2>
        <form action="index.php?page=register" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <div class="password-wrapper">
                <input type="password" name="password" id="password" placeholder="Password" required>
                <i class="fas fa-eye password-toggle" id="togglePassword"></i>
            </div>
            <button type="submit">Register</button>
        </form>
    </div>
</div>

<script>
document.getElementById("togglePassword").addEventListener("click", function () {
    const password = document.getElementById("password");
    const type = password.getAttribute("type") === "password" ? "text" : "password";
    password.setAttribute("type", type);
    this.classList.toggle("fa-eye");
    this.classList.toggle("fa-eye-slash");
});
</script>

<?php include 'footer.php'; ?>
