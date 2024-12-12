<?php require  "templates/header.php"; ?>

<main>
    <div class="cards">
        <a href="blogs.php" class="card">
            <h2>Posts</h2>
            <p class="card-description">Read blog posts and rate them.</p>
        </a>
        <a href="BlogsWriting.php" class="card">
            <h2>Write your own Post!</h2>
            <p class="card-description">Share your thoughts with us.</p>
        </a>
        <a href="kollegen.php" class="card">
            <h2>Explore</h2>
            <p class="card-description">Explore new blogs and people.</p>
        </a>
    </div>
</main>

<style>
    .cards {
        display: flex;
        flex-wrap: wrap;
        gap: 2rem;
        justify-content: center;
    }

    .card {
        background-color: #6a0dad;
        color: white;
        padding: 2rem;
        text-align: center;
        border-radius: 10px;
        text-decoration: none;
        font-size: 1.2rem;
        width: 250px;
        height: 200px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        gap: 10px;
    }

    .card:hover {
        transform: translateY(-10px);
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
    }

    .card-description {
        font-size: 0.9rem;
        font-weight: 300;
        color: #f3e6ff;
        margin: 0;
        text-align: center;
        line-height: 1.4;
    }

</style>

<footer>
    <p>&copy; 2024 | Zehras Blog</p>
</footer>
