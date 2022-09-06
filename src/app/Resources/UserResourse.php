<?php

namespace App\Resources;

use App\Interfaces\ResourceInterface;

class UserResourse implements ResourceInterface
{
    public function toArray(object $data): array
    {
        return [
            'id' => $data->id,
            'email' => $data->email,
            'admin' => $data->admin,
            'created' => $data->created,
        ];
    }

    public function append(array $array): array
    {
        return [
            'data' => $array
        ];
    }
}