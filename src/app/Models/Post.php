<?php

declare(strict_types=1);

namespace App\Models;

use App\Entity\PostEntity;
use Slim\Collection;

class Post extends BaseModel
{
    /**
     * @var string
     */
    protected $table = 'posts';

    /**
     * @var string[]
     */
    protected $usable = ['id', 'title', 'content', 'url'];

    /**
     * @var string
     */
    protected $entityClassName = 'PostEntity';

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        $result = $this->db->query("SELECT * FROM {$this->table} ORDER BY id DESC")->fetchAll(\PDO::FETCH_ASSOC);
        if ($result) {
            return $this->return($result);
        }

        return new Collection();
    }

    /**
     * @param int $id
     * @return void|null
     */
    public function get(int $id)
    {
        $result = $this->db->query("SELECT * FROM {$this->table} WHERE id='{$id}'")->fetch(\PDO::FETCH_ASSOC);

        return $result !== false ? $this->return($result) : null;
    }

    /**
     * @param array $data
     */
    public function add(array $data)
    {
        $stmt = $this->db->prepare(
            "INSERT INTO {$this->table} (`user_id`, `title`, `content`, `created`) VALUES (:user_id, :title, :content, :created)"
        );

        $stmt->execute($data);

        return $this->db->lastInsertId();
    }

    /**
     * @param PostEntity $post
     * @return bool
     */
    public function update(PostEntity $post): bool
    {
        $stmt = $this->db->prepare("UPDATE {$this->table} SET title=?, content=?, created=? WHERE id=?");

        return $stmt->execute([$post->title, $post->content, $post->created, $post->id]);
    }

    /**
     * @param int $postId
     * @param string $url
     * @return bool
     */
    public function handleImage(int $postId, string $url): bool
    {
        $stmt = $this->db->prepare("UPDATE {$this->table} SET url=? WHERE id=?");

        return $stmt->execute([$url, $postId]);
    }

}