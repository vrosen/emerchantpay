<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Post;
use App\Entity\PostEntity;
use PDO;

class PostService
{
    /**
     * @var Post
     */
    protected $post;

    /**
     * @param PDO $db
     */
    public function __construct(PDO $db)
    {
        $this->post = new Post($db);
    }

    /**
     * @return \Slim\Collection
     */
    public function getPosts()
    {
        return $this->post->all();
    }

    /**
     * @param int $id
     * @return void|null
     */
    public function getPost(int $id)
    {
        return $this->post->get($id);
    }

    /**
     * @param array $data
     */
    public function createPost(array $data)
    {
        $data['created'] = date('Y-m-d H:i:s');
        $data['title'] = addslashes(trim($data['title']));
        $data['content'] = addslashes(trim($data['content']));

        return $this->post->add($data);
    }

    /**
     * @param PostEntity $post
     * @param array $data
     * @return bool
     */
    public function updatePost(PostEntity $post, array $data): bool
    {
        $post->title = addslashes(trim($data['title']));
        $post->content = addslashes(trim($data['content']));
        $post->created = date('Y-m-d H:i:s');

        return $this->post->update($post);
    }

    /**
     * @param int $postId
     * @param string $filename
     * @param string $dir
     * @param string $baseUrl
     * @return bool
     */
    public function handleImage(int $postId, string $filename, string $dir, string $baseUrl)
    {
        $url = $baseUrl . DIRECTORY_SEPARATOR . $dir . DIRECTORY_SEPARATOR . $filename;

        return $this->post->handleImage($postId, $url);
    }
}