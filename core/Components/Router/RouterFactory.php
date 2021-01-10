<?php


namespace Aigletter\Core\Components\Router;


use Aigletter\Core\Components\Router\Router;
use Aigletter\Core\Components\Router\Router;
use Aigletter\Core\Contracts\ComponentAbstract;
use Aigletter\Core\Contracts\ComponentFactoryAbstract;

/**
 * Class RouterFactory
 * Фабрика, умеющая создавать экземпляр роутера
 * Паттерн Factory Method
 *
 * @package Aigletter\Core\Components\Router
 */
class RouterFactory extends ComponentFactoryAbstract, Router/**
 * @inheritDoc
 */
    protected function createConcreteInstance(): ComponentAbstract
    {
        // TODO: Implement createConcreteInstance() method.
    }, Router
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