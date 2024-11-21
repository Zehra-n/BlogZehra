<?php

$host1 = 'localhost';
$db1 = 'blog';
$user1 = 'root';
$pass1 = '';

try {
    $pdo1 = new PDO("mysql:host=$host1;dbname=$db1;charset=utf8", $user1, $pass1);
    $pdo1->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Verbindung zur ersten Datenbank fehlgeschlagen: " . $e->getMessage());
}


$host2 = 'mysql2.webland.ch';
$db2 = 'd041e_urs';
$user2 = 'd041e_urs_ro';
$pass2 = 'PW_d041e_urs_ro';

try {
    $pdo2 = new PDO("mysql:host=$host2;dbname=$db2;charset=utf8", $user2, $pass2);
    $pdo2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Verbindung zur zweiten Datenbank fehlgeschlagen: " . $e->getMessage());
}
?>
