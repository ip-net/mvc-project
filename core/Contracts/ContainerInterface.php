<?php


namespace Iliah\Core\Contracts;


/**
 * Interface ContainerInterface
 * Интерфейс для методов контейнера.
 *
 * Про контейнеры станет понятнее после соответствующей темы о Dependency Injection
 *
 * @package Iliah\Core\Contracts
 */
interface ContainerInterface
{
    /**
     * Получает сервис с контейнера по его имени
     *
     * @param $name
     * @return mixed
     */
    public function get($name);

    /**
     * Проверяет есть ли в контейнере зарегистрированный севрис по его имени
     *
     * @param $name
     * @return mixed
     */
    public function has($name);
}