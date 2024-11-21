<?php
$host = 'localhost'; // Datenbank-Host
$db = 'blog'; // Name der Datenbank
$user = 'root'; // Benutzername
$pass = ''; // Passwort

try {
    // Verbindung zur Datenbank
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    // Fehler-Modus aktivieren
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Verbindung fehlgeschlagen: " . $e->getMessage());
}
?>


