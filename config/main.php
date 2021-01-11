<?php

/**
 * Конфигурационный файл приложения
 */

use Iliah\Core\Components\Hello\HelloFactory;
use Iliah\Core\Components\Logger\Logger;
use Iliah\Core\Components\Router\RouterFactory;
use App\Component\Test\TestFactory;

return [
    // Массив конфигураций сервисов
    'components' => [
        'router' => [
            'factory' => RouterFactory::class,
        ],
        'hello' => [
            'factory' => HelloFactory::class,
        ],
        'test' => [
            'factory' => TestFactory::class,
        ],
        'logger' => Logger::class
    ],
    // ...
    // Здесь могут содержаться другие настройки приложения, кроме сервисов
];