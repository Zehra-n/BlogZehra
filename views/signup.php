<?php
require "templates/header.php";
require 'db.php';

// Prüfe, ob der POST-Request erfolgt ist, um die Registrierung zu verarbeiten
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Überprüfen, ob der Benutzername bereits existiert
    try {
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = :username");
        $stmt->execute(['username' => $username]);
        $existingUserCount = $stmt->fetchColumn();

        if ($existingUserCount > 0) {
            // Wenn der Benutzername bereits existiert, gib eine Fehlermeldung aus
            $error_message = "Username is already taken. Please choose a different one.";
        } else {
            // Wenn der Benutzername nicht existiert, fahre fort mit der Registrierung
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);
            $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
            $stmt->execute(['username' => $username, 'password' => $hashed_password]);

            // Weiterleitung zur Login-Seite nach erfolgreicher Registrierung
            header("Location: login.php");
            exit;
        }
    } catch (PDOException $e) {
        // Fehlerbehandlung, falls etwas schief geht
        $error_message = "Error during registration: " . htmlspecialchars($e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Blog</title>
    <link rel="stylesheet" href="style.css">
    <style>

        .signup-container {
            width: 100%;
            max-width: 400px;
            background-color: #fff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin: 50px auto;
            text-align: center;
        }

        .signup-container h2 {
            font-size: 2rem;
            color: #6a0dad;
            margin-bottom: 1.5rem;
        }

        .signup-container .form-group {
            margin-right: 35px;
            margin-bottom: 1.2rem;
            text-align: left;
        }

        .signup-container .form-group label {
            display: block;
            font-weight: bold;
            color: #333;
        }

        .signup-container .form-group input {
            width: 100%;
            padding: 1rem;
            margin-top: 0.5rem;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
        }

        .signup-container .form-group input:focus {
            border-color: #6a0dad;
        }

        .signup-container .submit-btn {
            width: 100%;
            padding: 1rem;
            background-color: #6a0dad;
            color: white;
            font-size: 1.1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .signup-container .submit-btn:hover {
            background-color: #8b2bb3;
        }

        .signup-container p {
            margin-top: 1.5rem;
        }

        .signup-container p a {
            color: #6a0dad;
            text-decoration: none;
        }

        .signup-container p a:hover {
            text-decoration: underline;
        }

        .error-message {
            color: red;
            margin-top: 10px;
            font-size: 1rem;
            text-align: center;
        }
    </style>
</head>
<body>

<main>
    <div class="signup-container">
        <h2>Sign up</h2>

        <!-- Registrierung Formular -->
        <form action="signup.php" method="POST" class="signup-form">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit" class="submit-btn">Register</button>
        </form>

        <p>Already have an account? <a href="login.php"> Log in</a></p>

        <!-- Fehlernachricht, falls der Benutzername bereits vergeben ist oder andere Fehler auftreten -->
        <?php
        if (isset($error_message)) {
            echo "<p class='error-message'>$error_message</p>";
        }
        ?>
    </div>
</main>

<footer>
    <p>&copy; 2024 | Zehras Blog</p>
</footer>

</body>
</html>
