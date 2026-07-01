<?php

declare(strict_types=1);

define('ROOT', dirname(__DIR__));

require_once ROOT . '/config/autoload.php';

app\Helpers\Env::load(ROOT . '/.env');
app\Helpers\Session::start();

$config = require ROOT . '/config/app.php';
date_default_timezone_set($config['timezone']);

if ($config['debug']) {
    ini_set('display_errors', '1');
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', '0');
    error_reporting(0);
}

$router = require ROOT . '/routes/web.php';

$uri    = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$basePublic = '/SwiftCargo/public';
$baseRoot   = '/SwiftCargo';
if (str_starts_with($uri, $basePublic)) {
    $uri = substr($uri, strlen($basePublic));
} elseif (str_starts_with($uri, $baseRoot)) {
    $uri = substr($uri, strlen($baseRoot));
}
if (str_starts_with($uri, '/index.php')) {
    $uri = substr($uri, strlen('/index.php'));
}
$uri    = '/' . ltrim($uri, '/');
$method = $_SERVER['REQUEST_METHOD'];

$router->dispatch($method, $uri);
