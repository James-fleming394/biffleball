<?php include 'header.php'; ?>

<style>
.register-wrapper {
    display: flex;
    align-items: stretch;
    justify-content: center;
    min-height: 100vh;
    padding: 2rem 4rem;
    gap: 2rem;
    background: linear-gradient(135deg, rgb(27, 19, 183), rgb(110, 174, 246));
    margin-bottom: -5%;
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
    max-height: 500px;
    max-width: 600px;
    overflow: hidden;
    position: relative;
}

.logo-box {
    align-items: center;
    text-align: center;
    position: relative;
    justify-content: space-between;
}

.logo-box img {
    max-width: 70%;
    height: auto;
    margin-top: 2rem;
    margin-bottom: auto;
}

.socials {
    display: flex;
    justify-content: center;
    gap: 40px;
    margin-top: auto;
    padding-top: 2rem;
}

.socials a {
    font-size: 24px;
    color: #0074D9;
    transition: transform 0.3s ease;
}

.socials a:hover {
    transform: scale(1.75);
}

.register-box {
    justify-content: flex-start;
}

.register-box h2 {
    font-size: 3rem;
    color: #0074D9;
    margin-bottom: 1rem;
}

.form-wrapper {
    margin-top: 12%;
    width: 100%;
}

form {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    gap: 1rem;
}

form input,
form button {
    width: 100%;
    padding: 0.75rem 1rem;
    font-size: 1rem;
    border: 1px solid #ccc;
    border-radius: 6px;
    box-sizing: border-box;
}

input[type="text"],
input[type="email"],
input[type="password"] {
    font-size: 1rem;
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
    top: 55%;
    right: 0.75rem;
    transform: translateY(-50%);
    cursor: pointer;
    font-size: 1.2rem;
    color: #888;
}

.terms {
    display: flex;
    align-items: center;
    font-size: 0.85rem;
    gap: 0.5rem;
    flex-wrap: nowrap;
    white-space: nowrap;
}

.terms input[type="checkbox"] {
    transform: scale(1.1);
    margin: 0;
}

.terms label {
    margin: 0;
    line-height: 1.4;
}

.terms a {
    color: #0074D9;
    text-decoration: underline;
}

.terms a:hover {
    color: rgb(4, 72, 131);
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
        <div class="form-wrapper">
            <form action="index.php?page=register" method="POST">
                <input type="text" name="username" placeholder="Username" required>
                <input type="email" name="email" placeholder="Email" required>
                <div class="password-wrapper">
                    <input type="password" name="password" placeholder="Password" id="password" required>
                    <i class="fas fa-eye toggle-password" id="togglePassword"></i>
                </div>
<div class="terms">
    <input type="checkbox" name="terms" id="terms" required>
    <span>I agree to the <a href="terms.php" target="_blank">Terms of Service</a></span>
</div>
                <button type="submit">Register</button>
            </form>
        </div>
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