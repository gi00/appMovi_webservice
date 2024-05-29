<?php

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);

if ($uri[1] !== 'api') {
    header("HTTP/1.1 404 Not Found");
    exit();
}

if ($uri[2] === 'login' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    require 'userRoutes.php';
} else {
    header("HTTP/1.1 404 Not Found");
    exit();
}

?>
