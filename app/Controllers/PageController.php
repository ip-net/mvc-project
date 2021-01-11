<?php


namespace App\Controllers;


use Iliah\Core\Application;
use Iliah\Core\Components\Logger\Logger;

/**
 * Class PageController
 * Контроллер для обработки запросов каких-то страниц нашего прилоежения
 *
 * @package App\Controllers
 */
class PageController
{
    /**
     * Действие по умолчанию
     */
    protected $logger;

    public function __construct()
    {
        $this->logger = Logger::getInstance();
    }

    public function indexAction()
    {
        echo 'IndexAction PageController';
    }

    /**
     * Действие посмотр страницы
     */
    public function viewAction()
    {
        $this->logger->info("class PageController. viewAction");
        $app = Application::getInstance();
        if ($app->has('test')) {
            echo $app->get('test')->run();
        }
    }

    /**
     * Действие обновление страницы
     */
    public function updateAction()
    {
        echo 'Update action';
    }
}