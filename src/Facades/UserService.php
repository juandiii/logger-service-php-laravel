<?php

namespace JuanDiii\LoggerService\Facades;

use Illuminate\Support\Facades\Facade;
use JuanDiii\LoggerService\Models\User\User;

/**
 * @method static User getMe();
 *
 */
class UserService extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'UserService';
    }
}
