<?php

namespace Geow\NotFoundMonitor\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Geow\NotFoundMonitor\NotFoundMonitor
 */
class NotFoundMonitor extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Geow\NotFoundMonitor\NotFoundMonitor::class;
    }
}
