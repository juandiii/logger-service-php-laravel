<?php

namespace JuanDiii\LoggerService\Models\User;

class User
{
    const ID = "id";
    const USERNAME = "username";
    const EMAIL = "email";
    const ENABLED = "enabled";
    const TOKEN = "token";

    private $id;
    private $username;
    private $email;
    private $enabled;
    private $token;

    public function __construct($data)
    {
        $this->id = $data[User::ID];
        $this->username = $data[User::USERNAME];
        $this->email = $data[User::EMAIL];
        $this->enabled = $data[User::ENABLED];
        $this->token = $data[User::TOKEN];
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function isEnabled()
    {
        return $this->enabled;
    }

    public function getToken()
    {
        return $this->token;
    }
}
