<?php

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
    default:
        require __DIR__ . '/404.php';
        break;
}