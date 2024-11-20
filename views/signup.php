<?php require "templates/header.php"; ?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Blog</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Signup-Container Design */
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

        /* Signup Titel */
        .signup-container h2 {
            font-size: 2rem;
            color: #6a0dad;
            margin-bottom: 1.5rem;
        }

        /* Form Group */
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

        /* Submit Button */
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

        /* Styling für den Link-Text im Signup-Formular */
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

    </style>
</head>
<body>

<main>
    <div class="signup-container">
        <h2>Registrieren</h2>

        <form action="signup_action.php" method="POST" class="signup-form">

            <div class="form-group">
                <label for="username">Benutzername:</label>
                <input type="text" id="username" name="username" required value="<?= isset($username) ? htmlspecialchars($username) : '' ?>">
            </div>

            <div class="form-group">
                <label for="password">Passwort:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit" class="submit-btn">Registrieren</button>
        </form>

        <p>Bereits ein Konto? <a href="login.php">Jetzt einloggen</a></p>
    </div>
</main>


</body>
</html>


