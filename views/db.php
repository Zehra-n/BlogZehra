<?php

$host_local = 'localhost';
$db_local = 'blog';
$user_local = 'root';
$pass_local = '';

try {
    $pdo = new PDO("mysql:host=$host_local;dbname=$db_local;charset=utf8", $user_local, $pass_local);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Verbindung zur lokalen Datenbank fehlgeschlagen: " . $e->getMessage());
}


$host_remote = 'mysql2.webland.ch';
$db_remote = 'd041e_urs';
$user_remote = 'd041e_urs_ro';
$pass_remote = 'PW_d041e_urs_ro';

try {
    $pdo_remote = new PDO("mysql:host=$host_remote;dbname=$db_remote;charset=utf8", $user_remote, $pass_remote);
    $pdo_remote->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Verbindung zur entfernten Datenbank fehlgeschlagen: " . $e->getMessage());
}
?>

<?php

// Verbindung zur lokalen Datenbank
if (!isset($GLOBALS['pdo'])) {

    $host_local = 'localhost';
    $db_local = 'blog';
    $user_local = 'root';
    $pass_local = '';

    try {
        $GLOBALS['pdo'] = new PDO("mysql:host=$host_local;dbname=$db_local;charset=utf8", $user_local, $pass_local, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
    } catch (PDOException $e) {
        die("Verbindung zur lokalen Datenbank fehlgeschlagen: " . $e->getMessage());
    }
}

// Verbindung zur entfernten Datenbank
if (!isset($GLOBALS['pdo_remote'])) {

    $host_remote = 'mysql2.webland.ch';
    $db_remote = 'd041e_urs';
    $user_remote = 'd041e_urs_ro';
    $pass_remote = 'PW_d041e_urs_ro';

    try {
        $GLOBALS['pdo_remote'] = new PDO("mysql:host=$host_remote;dbname=$db_remote;charset=utf8", $user_remote, $pass_remote, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
    } catch (PDOException $e) {
        die("Verbindung zur entfernten Datenbank fehlgeschlagen: " . $e->getMessage());
    }
}
?>
