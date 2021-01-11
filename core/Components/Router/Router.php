<?php


namespace Iliah\Core\Components\Router;


use Iliah\Core\Components\Logger\Logger;
use Iliah\Core\Contracts\ComponentAbstract;

/**
 * Class Router
 * Полезный сервис, который занимается роутингом (маршрутизацией).
 * Суть его в том, чтобы определить какое действие (какой метод какого класса) нужно выполнить по каждому конкретному запросу (урлу)
 *
 * @package Iliah\Core\Components\Router
 */
class Router extends ComponentAbstract
{
    /**
     * Пока данный метод парсит строку и по пути запроса определяем контроллер и метод, который нужно вызвать
     * В дальнейшем планируется усовершенствовать этот механизм, чтобы можно было более гибко настраивать роуты
     *
     * @return \Closure
     * @throws \Exception
     */

    protected $logger;

    public function __construct()
    {
        $this->logger = Logger::getInstance();
    }

    public function route()
    {
        $this->logger->info("class Router. route");
        // Получаем путь с адресной строки
        $path = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

        // Определяем контроллер и действие по умолчанию.
        // Если контроллера и действия не будет в строке запроса, будут отрабатывать дефолтные
        $controllerName = 'App\\Controllers\\IndexController';
        $actionName = 'indexAction';

        // Если конроллер есть в урле, определяем имя класса
        if (!empty($path[1])) {
            $controllerName = 'App\\Controllers\\' . ucfirst($path[1]) . 'Controller';
        }

        // Если класс конроллера не найден, выкидываем исключение.
        // В дальнейшем будем это исключение обрабатывать и выводить 404
        if (!class_exists($controllerName)) {
            throw new \Exception("Class not found");
        }

        // Создаем экземпляр класса контроллера
        $controller = new $controllerName();

        // Если действие есть в урле, определяем его имя
        if (isset($path[2])) {
            $actionName = $path[2] . 'Action';
        }

        // Если метод не найден в классе контроллера, выкидываем исключение
        // В дальнейшем будем это исключение обрабатывать и выводить 404
        if (!method_exists($controller, $actionName)) {
            throw new \Exception('Action not found');
        }

        // Возвращаем функцию, которую могут вызвать
        return function() use ($controller, $actionName){
            $controller->$actionName($this->getParams());
        };
    }

    // Это временный и не очень умный метод.
    public function getParams()
    {
        return $_GET;
    }
}