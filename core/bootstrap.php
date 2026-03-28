<?php
const DIR_CONFIG = '/../config';
require_once __DIR__ . '/../vendor/autoload.php';

function getConfigs(string $path = DIR_CONFIG): array {
    $settings = [];
    foreach (scandir(__DIR__ . $path) as $file) {
        $name = explode('.', $file)[0];
        if (!empty($name) && $file !== '.' && $file !== '..') {
            $settings[$name] = include __DIR__ . "$path/$file";
        }
    }
    return $settings;
}

// Создаем ОДИН экземпляр приложения
$app = new Src\Application(new Src\Settings(getConfigs()));

// Регистрируем функцию-хелпер
function app() {
    global $app;
    return $app;
}

// Загружаем роуты ПОСЛЕ создания $app
require_once __DIR__ . '/../routes/web.php';

return $app;
