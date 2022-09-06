<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\TokenService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Traits\UserResponseTrait;

class UserController extends BaseController
{
    use UserResponseTrait;

    /**
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     */
    public function login(Request $request, Response $response, array $args): Response
    {
        $user = $this->userService->getFromCredentials($request->getParsedBody());

        if ($user) {
            try {
                $token = TokenService::create($user, $this->settings);
                return $this->response(
                    $response,
                    [
                        'success' => true,
                        'user' => array_merge(UserResponseTrait::transformSingle($user), ['jwt_token' => $token])
                    ],
                    200
                );
            } catch (\Exception $e) {
                return $this->response($response, ['success' => false, 'error' => $e->getMessage()], 404);
            }
        } else {
            return $this->response($response, ['success' => false, 'error' => 'Not found user'], 404);
        }
    }
}