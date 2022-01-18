<?php

namespace App\Services;

abstract class Service
{

    /**
     * @param string $method
     * @param array $arguments
     *
     * @return mixed
     */
    public static function __callStatic(string $method, array $arguments)
    {
        return call_user_func_array([app(static::class), $method], $arguments);
    }

    /**
     * @param string $method
     * @param array $arguments
     *
     * @return mixed
     */
    public function __call(string $method, array $arguments)
    {
        return call_user_func_array([$method], $arguments);
    }
}
