<?php
$page = basename($_SERVER['REQUEST_URI'] ?? '');

$viewDir = "views";

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
        require $viewDir . '/BlogsWriting.php';
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
    default:
        http_response_code(404);
        require $viewDir . '/404_view.php';
}
?>