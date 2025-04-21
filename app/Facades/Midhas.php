<?php

namespace App\Facades;

class Midhas
{

    public static function resolveFacade($name)
    {
        return app()[$name];
    }

    public static function __callStatic($method, $arguments)
    {
        return (self::resolveFacade('Midhas'))->$method(...$arguments);
    }
}
