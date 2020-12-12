<?php

namespace JuanDiii\LoggerService\Service;

use Illuminate\Support\Facades\App;
use JuanDiii\LoggerService\Models\User\User;
use JuanDiii\LoggerService\Service\GuzzleClient;

class UserService
{

    public function getMe(): User
    {
        /**
         * @var GuzzleClient $connect
         */
        $connect = App::make(GuzzleClient::class);

        $data = $connect->get('/api/v1/users');

        $user = new User($data);

        return $user;
    }
}
