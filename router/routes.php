<?php
// Überprüfen, ob eine Session bereits gestartet wurde, um Fehler zu vermeiden
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Nur starten, wenn noch keine Session aktiv ist
}

$page = basename($_SERVER['REQUEST_URI'] ?? '');

$viewDir = "views";

// Überprüfe, ob der Benutzer eingeloggt ist
$userLoggedIn = isset($_SESSION['user_id']);

switch ($page) {
    case 'zehra':
    case 'home':
    case 'index.php':
        require $viewDir . '/home.php';
        break;

    case 'blogs.php':
        require $viewDir . '/blogs.php';
        break;

    case 'BlogsWriting.php':
        if ($userLoggedIn) {
            require $viewDir . '/BlogsWriting.php';
        } else {
            // Weiterleitung zur Login-Seite, wenn der Benutzer nicht eingeloggt ist
            header("Location: login.php");
            exit();
        }
        break;

    case 'login.php':
        require $viewDir . '/login.php';
        break;

    case 'signup.php':
        require $viewDir . '/signup.php';
        break;

    case 'logout.php':
        require $viewDir . '/logout.php';
        break;

    case 'kollegen.php':
        require $viewDir . '/kollegen.php';
        break;

    case 'rate.php':
        require $viewDir . '/rate.php';
        break;

    case 'account.php':
        if ($userLoggedIn) {
            require $viewDir . '/account.php';  // Zeige das Benutzerkonto, wenn der Benutzer eingeloggt ist
        } else {
            // Weiterleitung zur Login-Seite, wenn der Benutzer nicht eingeloggt ist
            header("Location: login.php");
            exit();
        }
        break;

    default:
        http_response_code(404);
        require $viewDir . '/404_view.php';
}
?>
