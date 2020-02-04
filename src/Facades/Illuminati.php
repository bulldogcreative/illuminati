<?php

namespace Bulldog\Illuminati\Facades;

use Illuminate\Support\Facades\Facade;

class Illuminati extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'illuminati';
    }
}
