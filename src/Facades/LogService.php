<?php

namespace JuanDiii\LoggerService\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static function debug($message);
 * @method static function error($message);
 *
 */
class LogService extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'LogService';
    }
}
