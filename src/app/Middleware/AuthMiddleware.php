<?php

namespace App\Middleware;

use App\Services\AuthService;

class AuthMiddleware
{
    private $config;

    public function __construct(array $config) {
        $this->config = $config;
    }

    /**
     * Example middleware invokable class
     *
     * @param  \Psr\Http\Message\ServerRequestInterface $request  PSR7 request
     * @param  \Psr\Http\Message\ResponseInterface      $response PSR7 response
     * @param  callable                                 $next     Next middleware
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke($request, $response, $next)
    {
        AuthService::auth($this->config);
        return $next($request, $response);
    }
}