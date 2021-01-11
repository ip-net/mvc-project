<?php


namespace App\Controllers;


use Iliah\Core\Components\Logger\Logger;

/**
 * Class IndexController
 * Контроллер по умолчанию
 *
 * @package App\Controllers
 */
class IndexController
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
        echo 'IndexAction IndexController';
    }
}