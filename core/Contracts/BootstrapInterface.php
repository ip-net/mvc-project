<?php


namespace Iliah\Core\Contracts;


/**
 * Interface BootstrapInterface
 * Интерфейс нужен для того, чтобы производить какую-то начальную загрузку.
 *
 * @package Iliah\Core\Contracts
 */
interface BootstrapInterface
{
    public function bootstrap();
}