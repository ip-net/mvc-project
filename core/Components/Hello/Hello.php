<?php


namespace Iliah\Core\Components\Hello;


use Iliah\Core\Contracts\ComponentAbstract;
use Iliah\Core\Components\Logger\Logger;

/**
 * Class Hello
 * Класс бесполезного демонстрационного севриса
 * В дальнейшем удалим
 *
 * @package Iliah\Core\Components\Hello
 */
class Hello extends ComponentAbstract
{
    protected $param1;

    protected $param2;

    protected $logger;

    public function __construct($param1, $param2)
    {
        $this->param1 = $param1;
        $this->param2 = $param2;
        $this->logger = Logger::getInstance();
    }

    public function test()
    {
        echo "Hello world";
    }
}