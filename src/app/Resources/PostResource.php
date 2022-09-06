<?php

namespace App\Resources;

use App\Interfaces\ResourceInterface;

class PostResource implements ResourceInterface
{
    public function toArray(object $data): array
    {
        return [
            'id' => $data->id,
            'title' => $data->title,
            'content' => $data->content,
            'url' => $data->url,
        ];
    }

    public function append(array $array): array
    {
        return [
            'data' => $array
        ];
    }
}