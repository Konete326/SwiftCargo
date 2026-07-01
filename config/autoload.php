<?php

declare(strict_types=1);

spl_autoload_register(function (string $class): void {
    $base = dirname(__DIR__);
    $file = $base . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});
