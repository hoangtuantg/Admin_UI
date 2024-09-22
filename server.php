<?php

declare(strict_types=1);
$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
);

if ('/' !== $uri && file_exists(__DIR__ . '/public' . $uri)) {
    return false;
}

if('local' === getenv('APP_ENV')) {
    require_once __DIR__ . '/public/index.php';
} else {
    require_once __DIR__ . '/index.php';
}
