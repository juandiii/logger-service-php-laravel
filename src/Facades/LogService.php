<?php

namespace JuanDiii\LoggerService\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static function debug($appName, $message);
 * @method static function error($appName, $message);
 *
 */
class LogService extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'LogService';
    }
}
