<?php

namespace App\Middleware;

use App\Traits\PostResponseTrait;

class ValidationMiddleware
{
    use PostResponseTrait;

    protected $errors = [];
    protected $validators = [];

    public function __construct($validators = [])
    {
        if (is_array($validators) || $validators instanceof \ArrayAccess) {
            $this->validators = $validators;
        } elseif (is_null($validators)) {
            $this->validators = [];
        }
    }

    /**
     * Example middleware invokable class
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request PSR7 request
     * @param \Psr\Http\Message\ResponseInterface $response PSR7 response
     * @param callable $next Next middleware
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke($request, $response, $next)
    {
        $this->errors = [];
        $params = $request->getParams();
        $params = array_merge((array)$request->getAttribute('routeInfo')[2], $params);
        $this->validate($params, $this->validators);

        if (!empty($this->errors)) {
            return $response
                ->withHeader('Content-type', 'application/json')
                ->withJson(PostResponseTrait::notFound(['success' => false, $this->errors]), 404);
        }

        return $next($request, $response);
    }

    private function validate($params = [], $validators = [])
    {
        //possible to add validation interface and according classes to handle better all possible variations of the validations
        array_map(function ($param, $validator) {
            if (strpos($validator, '|')) {
                $rules = explode('|', $validator);
                foreach ($rules as $rule) {
                    if ($rule == 'numeric') {
                        if (!is_int((int)$param) || $param == 0) {
                            $this->errors['message'] = 'Only integer values allowed!';
                        }
                    }
                }
            }
        }, $params, $validators);
    }

}