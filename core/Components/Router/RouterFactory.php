<?php


namespace Iliah\Core\Components\Router;


use Iliah\Core\Components\Router\Router;
use Iliah\Core\Contracts\ComponentAbstract;
use Iliah\Core\Contracts\ComponentFactoryAbstract;

/**
 * Class RouterFactory
 * Фабрика, умеющая создавать экземпляр роутера
 * Паттерн Factory Method
 *
 * @package Iliah\Core\Components\Router
 */
class RouterFactory extends ComponentFactoryAbstract
 /**
 *
 * @inheritDoc
 */
{

    /**
     * Фабричный метод для создания экземпляра конкретного сервиса
     * @return ComponentAbstract
     */



    protected function createConcreteInstance(): ComponentAbstract
    {
        return new Router();
    }
}