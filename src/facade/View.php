<?php

namespace liansu\facade;

use liansu\Facade;

/**
 * @method string fetch(\liansu\interfaces\IViewHandler $viewHandler, $reqFile, $args = [])
 * @method void display(\liansu\interfaces\IViewHandler $viewHandler, $reqFile, $args = [])
 */
class View extends Facade
{
    protected static function getApplicationClassName(): string
    {
        return '\\liansu\\View';
    }
}