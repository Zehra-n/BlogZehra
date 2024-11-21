<?php
require "templates/header.php";
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beiträge - Blog</title>
    <link rel="stylesheet" href="style.css">
    <style>

        .content-container {
            width: 100%;
            max-width: 90%;
            height: 70%;
            margin: 50px auto;
            background: #fff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        post-title {

            font-size: 1.5rem;
            color: #6a0dad;
            margin-bottom: 1rem;
        }

        .post-content {
            font-size: 1rem;
            color: #333;
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }

        .no-posts {
            text-align: center;
            font-size: 1.2rem;
            color: #555;
        }

        .no-posts a {
            color: #6a0dad;
            text-decoration: none;
        }

        .no-posts a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>


<?php
require 'db.php';


try {
    // Beiträge abrufen
    $stmt = $pdo->prepare("SELECT posts.*, users.username FROM posts JOIN users ON posts.author_id = users.id ORDER BY posts.created_at DESC");
    $stmt->execute();
    $posts = $stmt->fetchAll();
} catch (PDOException $e) {
    echo "Fehler beim Laden der Beiträge: " . $e->getMessage();
}
?>

<div class="content-container">
    <h1>Blogs</h1>
    <?php if (empty($posts)): ?>
        <p class="no-posts">Es gibt momentan keine Blogs. <a href="BlogsWriting.php">Erstelle deinen Blog!</a></p>
    <?php else: ?>
        <?php foreach ($posts as $post): ?>
            <div class="post">
                <h2 class="post-title"><?= htmlspecialchars($post['title']) ?></h2>
                <p class="post-content"><?= nl2br(htmlspecialchars($post['content'])) ?></p>
                <?php if (!empty($post['image_url'])): ?>
                    <img src="<?= htmlspecialchars($post['image_url']) ?>" alt="Beitragsbild" style="max-width: 100%; height: auto;">
                <?php endif; ?>
                <p>Geschrieben von: <?= htmlspecialchars($post['username']) ?> am <?= $post['created_at'] ?></p>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<footer>
    <p>&copy; 2024 | Zehras Blog</p>
</footer>

</body>
</html>
