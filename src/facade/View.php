<?php

namespace liansu\facade;

use liansu\Facade;

class View extends Facade
{
    protected static function getApplicationClassName(): string
    {
        return '\\liansu\\View';
    }
}
