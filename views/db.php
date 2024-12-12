<?php
$host = 'localhost';
$dbname = 'blog';
$username = 'root';
$password = '';

try {
    // PDO-Verbindung zur lokalen Datenbank herstellen
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Verbindung fehlgeschlagen: " . $e->getMessage());
}

$conn = new mysqli($host, $username, $password, $dbname);

function getDatabaseConnection() {
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=blog', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die("Verbindungsfehler: " . $e->getMessage());
    }
}

if ($conn->connect_error) {
    die("Verbindung fehlgeschlagen: " . $conn->connect_error);
}

$conn->set_charset("utf8");


