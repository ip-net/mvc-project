<?php


namespace Iliah\Core\Components\Hello;


use Iliah\Core\Contracts\ComponentAbstract;
use Iliah\Core\Contracts\ComponentFactoryAbstract;

/**
 * Class HelloFactory
 * Фабрика, умеющая создавать экземпляр бесполезного класса.
 * Использовали для демонстрации. В дальнейшем удалим.
 *
 * Паттерн Factory Method
 *
 * @package Iliah\Core\Components\Hello
 */
class HelloFactory extends ComponentFactoryAbstract
{
    /**
     * Фабричный метод для создания экземпляра конкретного сервиса
     * @return ComponentAbstract
     */
    protected function createConcreteInstance(): ComponentAbstract
    {
        return new Hello('a', 'b');
    }
}