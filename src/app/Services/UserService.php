<?php

namespace App\Services;

use App\Models\User;
use Psr\Http\Message\ServerRequestInterface as Request;

use PDO;

class UserService
{
    /**
     * @var User
     */
    protected $user;

    /**
     * @param PDO $db
     */
    public function __construct(PDO $db)
    {
        $this->user = new User($db);
    }

    /**
     * @param array $data
     * @return void|null
     */
    public function getFromCredentials(array $data)
    {
        return $this->user->getFromCredentials($data['email'], $data['password']);
    }
}