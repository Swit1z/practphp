<?php
declare(strict_types=1);
// СТРОГО ПЕРВАЯ СТРОЧКА

try {
    $app = require_once __DIR__ . '/../core/bootstrap.php';
    $app->run();
} catch (\Throwable $exception) {
    echo '<pre>';
    print_r($exception);
    echo '</pre>';
}
session_start();