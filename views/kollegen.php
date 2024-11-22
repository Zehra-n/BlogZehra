<?php

$host_remote = 'mysql2.webland.ch';
$db_remote = 'd041e_urs';
$user_remote = 'd041e_urs_ro';
$pass_remote = 'PW_d041e_urs_ro';

try {

    $pdo_remote = new PDO("mysql:host=$host_remote;dbname=$db_remote;charset=utf8", $user_remote, $pass_remote);
    $pdo_remote->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Verbindung fehlgeschlagen: " . $e->getMessage());
}

$sql = "SELECT blog_url, blog_von FROM blogs WHERE jahr = 2024 AND blog_von != 'Zehra Nuhiu'";
$stmt = $pdo_remote->query($sql);
$blogs = $stmt->fetchAll();

require "templates/header.php";
?>

<title>Blogs der BLJ-Kollegen (2024)</title>
    <style>
        h1 {
            font-size: 2.5rem;
            color: #6a0dad;
            text-align: center;
            margin-top: 20px;
        }

        .author-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            gap: 15px;
            margin-top: 20px;
            padding: 0 20px;
        }

        .author-item {
            text-align: center;
        }

        .author-item a {
            text-decoration: none;
            color: #6a0dad;
            background: #d8bfd8;
            font-size: 1.2rem;
            font-weight: bold;
            padding: 10px;
            border: 1px solid #6a0dad;
            border-radius: 5px;
            display: inline-block;
            transition: background-color 0.3s;
        }

        .author-item a:hover {
            background-color: #6a0dad;
            color: #fffafa;
        }

        .no-blogs {
            text-align: center;
            font-size: 1.2rem;
            color: #333;
            margin-top: 20px;
        }
    </style>
<h1>Other interesting blogs!</h1>

<?php if (empty($blogs)): ?>
    <p class="no-blogs">There are currently no blogs.</p>
<?php else: ?>
    <div class="author-list">
        <?php foreach ($blogs as $blog): ?>
            <div class="author-item">
                <a href="<?php echo htmlspecialchars($blog['blog_url']); ?>" target="_blank">
                    <?php echo htmlspecialchars($blog['blog_von']); ?>'s Blog
                </a>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<footer>
    <p>&copy; 2024 | Zehras Blog</p>
</footer>
