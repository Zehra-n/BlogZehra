<?php
require 'db.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post_id = $_POST['post_id'];
    $rating = $_POST['rating'];
    $user_id = $_SESSION['user_id'];

    $stmt = $pdo->prepare("SELECT * FROM ratings WHERE post_id = :post_id AND user_id = :user_id");
    $stmt->execute(['post_id' => $post_id, 'user_id' => $user_id]);
    $existingRating = $stmt->fetch();

    if ($existingRating) {
        $update_stmt = $pdo->prepare("UPDATE ratings SET rating = :rating WHERE id = :id");
        $update_stmt->execute(['rating' => $rating, 'id' => $existingRating['id']]);
    } else {
        $insert_stmt = $pdo->prepare("INSERT INTO ratings (post_id, user_id, rating, created_at) VALUES (:post_id, :user_id, :rating, NOW())");
        $insert_stmt->execute(['post_id' => $post_id, 'user_id' => $user_id, 'rating' => $rating]);
    }
}

header('Location: blogs.php');
exit;
?>
