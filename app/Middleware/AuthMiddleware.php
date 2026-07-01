<?php

declare(strict_types=1);

namespace app\Middleware;

use app\Helpers\Session;

class AuthMiddleware
{
    public static function requireLogin(): void
    {
        Session::start();
        if (!Session::has('user_id')) {
            header('Location: /SwiftCargo/public/login');
            exit;
        }
    }

    public static function requireRole(string $role): void
    {
        self::requireLogin();
        if (Session::get('user_role') !== $role) {
            header('Location: /SwiftCargo/public/unauthorized');
            exit;
        }
    }

    public static function requireAdmin(): void
    {
        self::requireRole('admin');
    }

    public static function requireAgent(): void
    {
        self::requireRole('agent');
    }

    public static function guest(): void
    {
        Session::start();
        if (Session::has('user_id')) {
            $role = Session::get('user_role');
            header("Location: /SwiftCargo/public/{$role}/dashboard");
            exit;
        }
    }
}
