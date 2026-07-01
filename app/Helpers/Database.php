<?php

declare(strict_types=1);

namespace app\Helpers;

final class Database
{
    private static ?PDO $instance = null;

    public static function connect(): \PDO
    {
        if (self::$instance !== null) {
            return self::$instance;
        }

        $config = require dirname(__DIR__, 2) . '/config/database.php';

        $dsn = sprintf(
            'mysql:host=%s;port=%s;dbname=%s;charset=%s',
            $config['host'],
            $config['port'],
            $config['database'],
            $config['charset']
        );

        self::$instance = new \PDO($dsn, $config['username'], $config['password'], $config['options']);

        return self::$instance;
    }
}
