<?php


namespace App\Component\Test;


use Iliah\Core\Contracts\ComponentAbstract;
use Iliah\Core\Contracts\ComponentFactoryAbstract;

class TestFactory extends ComponentFactoryAbstract
{
    protected function createConcreteInstance(): ComponentAbstract
    {
        return new Test();
    }
}