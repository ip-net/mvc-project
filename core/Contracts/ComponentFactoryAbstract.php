<?php


namespace Iliah\Core\Contracts;


/**
 * Class ComponentFactoryAbstract
 * Абстрактный класс всех фабрик, умеющих создвать экземпляры сервисов.
 * Все сервисы должны создаваться с помощью фабрик
 * Каждая конкретаная фабрика сервиса должна реализовать метод createConcreteInstance
 * Паттерн Factory method
 *
 * @package Iliah\Core\Contracts
 */
abstract class ComponentFactoryAbstract
{
    /**
     * Публичный метод, который будет использоваться для создания экземпляра сервиса
     * @return ComponentAbstract
     */
    public function createInstance(): ComponentAbstract
    {
        return $this->createConcreteInstance();
    }

    /**
     * Фабричный метод, для создания конкретных экземпляров сервисов
     * @return ComponentAbstract
     */
    protected abstract function createConcreteInstance(): ComponentAbstract;
}