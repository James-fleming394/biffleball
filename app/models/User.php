<?php
require_once __DIR__ . '/../config.php';

class User {
    // Register a new user
    public static function create($username, $email, $password) {
        global $pdo;

        // Check if the email already exists
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            return false; // Email already registered
        }

        // Hash the password for security
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);

        // Insert the new user
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password_hash) VALUES (?, ?, ?)");
        return $stmt->execute([$username, $email, $passwordHash]);
    }

    // Find user by email (for login)
    public static function findByEmail($email) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Verify login credentials
    public static function verifyPassword($email, $password) {
        $user = self::findByEmail($email);
        if ($user && password_verify($password, $user['password_hash'])) {
            return $user; // Return user data if password is correct
        }
        return false;
    }

    // Find user by ID (for profile pages)
    public static function findById($id) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT id, username, email, created_at FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>