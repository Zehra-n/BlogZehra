<?php
$page = basename($_SERVER['REQUEST_URI'] ?? '');

$viewDir = "views";

switch ($page) {
    case 'zehra':
    case 'home':
    case 'index.php':
        require $viewDir . '/home.php';
        break;
    case 'Beiträge.php':
        require $viewDir . '/Beiträge.php';
        break;
    case 'BlogsWriting.php':
        require $viewDir . '/BlogsWriting.php';
        break;
    case 'login.php':
        require $viewDir . '/login.php';
        break;
    case 'signup.php':
        require $viewDir . '/signup.php';
        break;
    default:
        http_response_code(404);
        require $viewDir . '/404_view.php';
}
?>