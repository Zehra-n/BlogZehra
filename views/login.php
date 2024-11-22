<?php
require 'db.php';
require "templates/header.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['user_id'])) {

    $userLoggedIn = true;
} else {
    $userLoggedIn = false;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    try {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            $userLoggedIn = true;
        } else {

            $error_message = 'Username or password is incorrect.';
        }
    } catch (PDOException $e) {

        $error_message = 'Login error: ' . htmlspecialchars($e->getMessage());
    }
}
?>

<title>Login - Blog</title>
    <style>

        .login-container {
            width: 100%;
            max-width: 400px;
            background-color: #fffafa;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin: 50px auto;
            text-align: center;
        }

        .logged-in-container {
            width: 100%;
            max-width: 400px;
            background-color: #fffafa;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .login-container h2 {
            font-size: 2rem;
            color: #6a0dad;
            margin-bottom: 1.5rem;
        }

        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            color: #333;
        }

        .form-group input {
            width: 366px;
            padding: 1rem;
            margin-top: 0.5rem;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
        }

        .form-group input:focus {
            border-color: #6a0dad;
        }

        .submit-btn {
            width: 100%;
            padding: 1rem;
            background-color: #6a0dad;
            color: #fffafa;
            font-size: 1.1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .submit-btn:hover {
            background-color: #8b2bb3;
        }

        p {
            margin-top: 1.5rem;
        }

        p a {
            color: #6a0dad;
            text-decoration: none;
        }

        p a:hover {
            text-decoration: underline;
        }

        .error-message {
            color: red;
            margin-top: 10px;
            font-size: 1rem;
            text-align: center;
        }


    </style>

<main>
    <?php if ($userLoggedIn): ?>
        <div class="logged-in-container">
            <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
            <p>You are logged in. <a href="logout.php" class="btn">Log out</a></p>
            <p><a href="BlogsWriting.php">Write your own blog!</a></p>
        </div>
    <?php else: ?>

        <div class="login-container">
            <h2>Login</h2>
            <form action="login.php" method="POST" class="login-form">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" class="submit-btn">Login</button>

                <?php if (isset($error_message)): ?>
                    <div class="error-message"><?php echo $error_message; ?></div>
                <?php endif; ?>

            </form>
            <p>No account? <a href="signup.php">Sign up</a></p>
        </div>
    <?php endif; ?>
</main>

<footer>
    <p>&copy; 2024 | Zehras Blog</p>
</footer>
