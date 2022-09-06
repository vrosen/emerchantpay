<?php

declare(strict_types=1);

namespace App\Traits;

use App\Resources\PostResource;

trait PostResponseTrait
{
    /**
     * @param object $data
     * @return array
     */
    public static function transformSingle(object $data): array
    {
        $postResource = new PostResource();
        return $postResource->toArray($data);
    }

    /**
     * @param object $data
     * @return array
     */
    public static function transformMultiple(object $data): array
    {
        $array = [];
        $postResource = new PostResource();

        foreach ($data as $post) {
            $array[] = $postResource->toArray($post);
        }

        return $array;
    }

    /**
     * @param $data
     * @return array
     */
    public static function notFound($data): array
    {
        $postResource = new PostResource();
        return $postResource->append($data);
    }

    /**
     * @param $data
     * @return array
     */
    public static function single($data): array
    {
        $postResource = new PostResource();
        return $postResource->append($data);
    }
}