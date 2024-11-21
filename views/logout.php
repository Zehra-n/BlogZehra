<?php
session_start();

// Alle Session-Daten löschen
$_SESSION = [];

// Session beenden
session_destroy();

// Zurück zur Login-Seite leiten
header("Location: login.php");
exit;
?>
