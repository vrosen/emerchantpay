<?php

namespace App\Services;

class AuthService
{
    /**
     * @param array $config
     * @return void
     */
    public static function auth(array $config)
    {
        if (! preg_match('/Bearer\s(\S+)/', $_SERVER['HTTP_AUTHORIZATION'], $matches)) {
            header('HTTP/1.0 400 Bad Request');
            echo 'Token not found in request';
            exit;
        }

        $jwt = $matches[1];

        if (! $jwt) {
            header('HTTP/1.0 400 Bad Request');
            exit;
        }

        TokenService::get($jwt, $config);
    }
}