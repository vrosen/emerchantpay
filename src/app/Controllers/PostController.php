<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Traits\PostResponseTrait;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class PostController extends BaseController
{
    use PostResponseTrait;

    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function index(Request $request, Response $response): Response
    {
        return $this->response($response, PostResponseTrait::transformMultiple($this->postService->getPosts()));
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     */
    public function show(Request $request, Response $response, array $args): Response
    {
        $post = $this->postService->getPost((int)$args['id']);

        if ($post) {
            return $this->response($response, PostResponseTrait::transformSingle($post));
        } else {
            return $this->response($response, PostResponseTrait::notFound(['success' => false]), 404);
        }
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     */
    public function store(Request $request, Response $response, array $args): Response
    {
        $created = $this->postService->createPost($request->getParsedBody());
        if ($created) {
            if ($uploadedFiles = $request->getUploadedFiles()) {
                $filename = $this->fileService->upload($this->uploadDirectory, $uploadedFiles['image']);
                $this->postService->handleImage((int)$created, $filename, $this->uploadLinkDirectory, $this->base_url);
            }
            return $this->response($response, PostResponseTrait::single(['success' => true]), 201);
        } else {
            return $this->response($response, PostResponseTrait::notFound(['success' => false]), 404);
        }
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     */
    public function update(Request $request, Response $response, array $args): Response
    {
        $post = $this->postService->getPost((int)$args['id']);

        $updated = false;

        if ($post) {
            if ($request->getParsedBody()) {
                $updated = $this->postService->updatePost($post, $request->getParsedBody());
            }

            if ($uploadedFiles = $request->getUploadedFiles()) {
                $filename = $this->fileService->upload($this->uploadDirectory, $uploadedFiles['image']);
                $updated = $this->postService->handleImage(
                    (int)$args['id'],
                    $filename,
                    $this->uploadLinkDirectory,
                    $this->base_url
                );
            }

            if ($updated) {
                return $this->response($response, PostResponseTrait::single(['success' => true]), 200);
            } else {
                return $this->response($response, PostResponseTrait::notFound(['success' => false]), 404);
            }
        } else {
            return $this->response($response, PostResponseTrait::notFound(['success' => false]), 404);
        }
    }
}