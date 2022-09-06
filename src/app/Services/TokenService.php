<?php

namespace App\Services;

use App\Entity\UserEntity;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Slim\Collection;

final class TokenService
{
    /**
     * @param UserEntity $user
     * @param Collection $settings
     * @return string|void
     * @throws \Exception
     */
    public static function create(UserEntity $user, Collection $settings)
    {
        $issuedAt = new \DateTimeImmutable();

        $data = [
            'iat' => $issuedAt->getTimestamp(),
            'jti' => base64_encode(random_bytes(16)),
            'iss' => $settings['server_name'],
            'nbf' => $issuedAt->getTimestamp(),
            'exp' => $issuedAt->modify('+60 minutes')->getTimestamp(),
            'data' => [
                'userName' => $user->email,
            ]
        ];

        try {
            // Algorithm used to sign the token, see https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40#section-3
            return JWT::encode(
                $data,
                $settings['secret'],
                'HS256'
            );
        } catch (\Exception $e) {
            echo 'Exception: ', $e->getMessage(), "\n";
        }
    }

    /**
     * @param $jwt
     * @param array $config
     * @return void
     */
    public static function get($jwt, array $config)
    {
        $token = JWT::decode($jwt, new Key($config['secret'], 'HS256'));

        $now = new \DateTimeImmutable();

        if ($token->iss !== $config['server_name'] ||
            $token->nbf > $now->getTimestamp() ||
            $token->exp < $now->getTimestamp()) {
            header('HTTP/1.1 401 Unauthorized');
            exit;
        }
    }
}