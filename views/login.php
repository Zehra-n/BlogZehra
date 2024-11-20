<?php require "templates/header.php"; ?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Blog</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .login-container {
            width: 100%;
            max-width: 400px;
            background-color: #fff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin: 50px auto;
            text-align: center;
        }

        /* Login Titel */
        .login-container h2 {
            font-size: 2rem;
            color: #6a0dad;
            margin-bottom: 1.5rem;
        }

        /* Form Group */
        .form-group {
            margin-right: 35px;
            margin-bottom: 1.2rem;
            text-align: left;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            color: #333;
        }

        .form-group input {
            width: 100%;
            padding: 1rem;
            margin-top: 0.5rem;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
        }

        .form-group input:focus {
            border-color: #6a0dad;
        }

        /* Submit Button */
        .submit-btn {
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

        .submit-btn {
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




    </style>
</head>
<body>
<main>
    <div class="login-container">
        <h2>Login</h2>

        <form action="login_action.php" method="POST" class="login-form">
            <div class="form-group">
                <label for="username">Benutzername:</label>
                <input type="text" id="username" name="username" required>
            </div>

            <div class="form-group">
                <label for="password">Passwort:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit" class="submit-btn">Einloggen</button>
        </form>

        <p>Kein Konto? <a href="signup.php">Jetzt registrieren</a></p>
    </div>
</main>

<footer>
    <p>&copy; 2024 | Zehras Blog</p>
</footer>
</body>
</html>
