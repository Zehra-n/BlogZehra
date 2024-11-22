<?php
require "templates/header.php";
require 'db.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$username = '';
$postCount = 0;

if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];

    try {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :user_id");
        $stmt->execute(['user_id' => $userId]);
        $user = $stmt->fetch();

        if ($user) {
            $username = $user['username'];

            $stmt = $pdo->prepare("SELECT COUNT(*) FROM posts WHERE author_id = :author_id");
            $stmt->execute(['author_id' => $userId]);
            $postCount = $stmt->fetchColumn();
        } else {
            $username = 'User not found';
            $postCount = 0;
        }
    } catch (PDOException $e) {
        $error_message = "Error: " . $e->getMessage();
    }
} else {
    $error_message = "You must be logged in to view this page.";
}
?>

<title>Account - Zehras Blog</title>
<style>
    .account-container {
        width: 100%;
        max-width: 400px;
        background-color: #fffafa;
        padding: 2rem;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        margin: 50px auto;
        text-align: center;
    }

    .account-container h2 {
        display: block;
        font-weight: bold;
        color: #333;
    }

    .account-container p {
        font-size: 1rem;
    }

    .account-container a {
        font-size: 1rem;
        color: #6a0dad;
        margin-bottom: 1.5rem;
        text-decoration: none;
    }
</style>

<main>
    <div class="account-container">
        <?php if (isset($error_message)): ?>
            <p><?php echo htmlspecialchars($error_message); ?></p>
        <?php else: ?>
            <h2>Account of <?php echo htmlspecialchars($username); ?></h2>
            <p>You have <?php echo $postCount; ?> posts.</p>
            <p><a href="logout.php">Log out</a></p>
        <p><a href="BlogsWriting.php">Write your own Post!</a></p>
        <?php endif; ?>
    </div>
</main>

<footer>
    <p>&copy; 2024 | Zehras Blog</p>
</footer>
