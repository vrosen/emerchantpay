<?php

declare(strict_types=1);

namespace App\Controllers;

use \Psr\Http\Message\ResponseInterface as Response;
use Psr\Container\ContainerInterface;
use \Psr\Http\Message\ServerRequestInterface as Request;

class BaseController
{
    /**
     * @var ContainerInterface
     */
    protected $container;
    /**
     * @var mixed
     */
    protected $postService;
    /**
     * @var mixed
     */
    protected $userService;
    /**
     * @var mixed
     */
    protected $fileService;
    /**
     * @var mixed
     */
    protected $view;
    /**
     * @var mixed
     */
    protected $settings;
    /**
     * @var mixed
     */
    protected $uploadDirectory;
    /**
     * @var mixed
     */
    protected $uploadLinkDirectory;
    /**
     * @var mixed
     */
    protected $base_url;

    /**
     * @param ContainerInterface $container
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->postService = $this->container->get('post_service');
        $this->userService = $this->container->get('user_service');
        $this->fileService = $this->container->get('file_service');
        $this->view = $this->container->get('view');
        $this->settings = $this->container->get('settings');
        $this->uploadDirectory = $this->container->get('upload_directory');
        $this->uploadLinkDirectory = $this->container->get('upload_link_dir');
        $this->base_url = $this->container->get('base_url');
    }

    /**
     * @param Response $response
     * @param $data
     * @param $status
     * @return Response
     */
    public function response(Response $response, $data, $status = 200): Response
    {
        return $response
            ->withHeader('Content-type', 'application/json')
            ->withJson($data, $status);
    }
}