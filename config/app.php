<?php

declare(strict_types=1);

return [
    'name'    => $_ENV['APP_NAME']    ?? 'SwiftCargo',
    'env'     => $_ENV['APP_ENV']     ?? 'development',
    'debug'   => $_ENV['APP_DEBUG']   ?? true,
    'url'     => $_ENV['APP_URL']     ?? 'http://localhost/SwiftCargo/public',
    'timezone'=> $_ENV['APP_TZ']      ?? 'Asia/Karachi',
    'session_name' => 'swiftcargo_session',
];
