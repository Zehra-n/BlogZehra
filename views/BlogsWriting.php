<?php require "templates/header.php"; ?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Neuen Beitrag erstellen</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        main {
            width: 60%;
            margin: 50px auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            flex-direction: column;
        }

        h1 {
            text-align: center;
            color: #5a0d80;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }

        input[type="text"], textarea {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 20px;
            font-size: 15px;
        }

        textarea {
            resize: vertical;
            width: 500px;
        }

        button {
            margin-top: 30px;
            margin-bottom: 30px;
            padding: 10px 15px;
            background-color: #5a0d80;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            height: 50px;
        }

        button:hover {
            background-color: #7b29a8;
        }

        .success-message {
            background-color: #d4edda;
            color: #155724;
            padding: 15px;
            margin-top: 20px;
            border-radius: 5px;
            text-align: center;
        }

        .error-message {
            background-color: #f8d7da;
            color: #721c24;
            padding: 15px;
            margin-top: 20px;
            border-radius: 5px;
            text-align: center;
        }
    </style>
</head>
<body>

<?php
require 'db.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $image_url = trim($_POST['image']);
    $author_id = $_SESSION['user_id']; // Angemeldeter Benutzer

    try {
        // Blog-Beitrag speichern
        $stmt = $pdo->prepare("INSERT INTO posts (title, content, image_url, author_id) VALUES (:title, :content, :image_url, :author_id)");
        $stmt->execute([
            'title' => $title,
            'content' => $content,
            'image_url' => $image_url,
            'author_id' => $author_id,
        ]);

        // Erfolgsnachricht
        echo "<div class='success-message'>Post created successfully! <a href='blogs.php'>To the blogs</a></div>";
    } catch (PDOException $e) {
        // Fehlermeldung
        echo "<div class='error-message'>Error: " . $e->getMessage() . "</div>";
    }
}
?>

<main>
    <h1>Write your own blog!</h1>
    <form action="BlogsWriting.php" method="POST">

        <label for="title">Title:</label>
        <input type="text" id="title" name="title" placeholder="Enter the title of your blog" required>

        <label for="content">Content:</label>
        <textarea id="content" name="content" rows="5" placeholder="Write your content here" required></textarea>

        <label for="image">Image URL:</label>
        <input type="url" id="image" name="image" placeholder="Enter the URL of an image (optional)">

        <button type="submit">Create blog</button>
    </form>
</main>

<footer>
    <p>&copy; 2024 | Zehras Blog</p>
</footer>

</body>
</html>
