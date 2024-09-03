<?php

namespace liansu\interfaces;

interface IViewHandler
{
    public function __construct(array $configs);

    public function fetch($file, array $args = []): string;

    public function display($file, array $args = []);
}
