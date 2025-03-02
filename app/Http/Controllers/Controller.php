<?php

namespace App\Http\Controllers;

use Closure;

use function PHPUnit\Framework\isCallable;

abstract class Controller
{
    protected function resolve(Closure $call)
    {
        return $call();
    }
}
