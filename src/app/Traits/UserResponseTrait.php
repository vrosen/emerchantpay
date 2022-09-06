<?php

namespace App\Traits;

use App\Resources\UserResourse;

trait UserResponseTrait
{
    /**
     * @param object $data
     * @return array
     */
    public static function transformSingle(object $data): array
    {
        $postResource = new UserResourse();
        return $postResource->toArray($data);
    }
}