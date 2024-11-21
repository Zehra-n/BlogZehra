<?php
// Datenbankverbindung und Header einbinden
require 'db.php';
require "templates/header.php"; // Header einbinden

// Start der Session nur, wenn noch keine besteht
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Abrufen der Blog-Posts aus der Tabelle 'posts' in der Datenbank 'blog'
$stmt = $pdo->query("SELECT * FROM posts ORDER BY created_at DESC");
$posts = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blogs</title>
    <link rel="stylesheet" href="style.css">
    <style>
        h1 {
            font-size: 2.5rem;
            color: #6a0dad;
            margin-top: 20px;
            text-align: center;
        }

        .blog-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 80%;
            max-width: 900px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .blog-container img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .no-posts {
            font-size: 1.2rem;
            color: #333;
            margin: 20px 0;
            text-align: center;
        }

        .no-posts a {
            color: #6a0dad;
            text-decoration: none;
        }

        .no-posts a:hover {
            text-decoration: underline;
        }

        .blog-title {
            font-size: 1.8rem;
            color: #6a0dad;
            margin-bottom: 10px;
        }

        .blog-content {
            font-size: 1rem;
            color: #333;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .blog-meta {
            font-size: 0.9rem;
            color: #777;
            margin-top: 10px;
            text-align: left;
        }

        .blog-meta span {
            display: block;
            margin-bottom: 5px;
        }
    </style>
</head>
<body>

<h1>Blogs</h1>

<?php if (empty($posts)): ?>
    <!-- Wenn keine Blog-Posts existieren -->
    <p class="no-posts">There are currently no blogs. <a href="BlogsWriting.php">Write your own blog!</a></p>
<?php else: ?>
    <!-- Wenn Blog-Posts existieren, zeige sie in Containern -->
    <?php foreach ($posts as $post): ?>
        <?php
        // Autorname aus der users-Tabelle holen
        $author_stmt = $pdo->prepare("SELECT username FROM users WHERE id = :author_id");
        $author_stmt->execute(['author_id' => $post['author_id']]);
        $author = $author_stmt->fetch();
        ?>
        <div class="blog-container">
            <h2 class="blog-title"><?php echo htmlspecialchars($post['title']); ?></h2>
            <!-- Bild des Posts -->
            <?php if ($post['image_url']): ?>
                <img src="<?php echo htmlspecialchars($post['image_url']); ?>" alt="Blog image">
            <?php endif; ?>

            <p class="blog-content"><?php echo nl2br(htmlspecialchars($post['content'])); ?></p>

            <div class="blog-meta">

                <span>By: <?php echo htmlspecialchars($author['username']); ?></span>

                <span>Published on: <?php echo date('F j, Y, g:i a', strtotime($post['created_at'])); ?></span>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<!-- Footer -->
<footer>
    <p>&copy; 2024 | Zehras Blog</p>
</footer>

</body>
</html>
