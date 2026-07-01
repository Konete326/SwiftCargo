<?php

declare(strict_types=1);

namespace app\Controllers;

use app\Helpers\Session;

abstract class BaseController
{
    protected function view(string $viewPath, array $data = [], string $layout = ''): void
    {
        extract($data);
        $viewFile = dirname(__DIR__, 2) . '/views/' . $viewPath . '.php';

        if ($layout !== '') {
            ob_start();
            require $viewFile;
            $content = ob_get_clean();
            require dirname(__DIR__, 2) . '/views/layouts/' . $layout . '.php';
        } else {
            require $viewFile;
        }
    }

    protected function redirect(string $url): void
    {
        header("Location: $url");
        exit;
    }

    protected function redirectBack(): void
    {
        $ref = $_SERVER['HTTP_REFERER'] ?? '/';
        header("Location: $ref");
        exit;
    }

    protected function flashError(string $message): void
    {
        Session::flash('error', $message);
    }

    protected function flashSuccess(string $message): void
    {
        Session::flash('success', $message);
    }

    protected function isPost(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    protected function input(string $key, mixed $default = null): mixed
    {
        return $_POST[$key] ?? $default;
    }

    protected function sanitize(string $value): string
    {
        return htmlspecialchars(trim($value), ENT_QUOTES, 'UTF-8');
    }
}
