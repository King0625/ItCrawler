<?php
// die();
$request = $_SERVER['REQUEST_URI'];
switch ($request) {
    case '/' :
        require __DIR__ . '/output.php';
        break;
    case '' :
        require __DIR__ . '/output.php';
        break;
    case '/warning' :
        require __DIR__ . '/warning_notification.php';
        break;
    case '/weekend' :
        require __DIR__ . '/weekend.php';
        break;
    default:
        require __DIR__ . '/404.php';
        break;
}