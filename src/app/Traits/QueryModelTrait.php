<?php

declare(strict_types=1);

namespace App\Traits;

trait QueryModelTrait
{
    /**
     * @param array $usables
     * @param array $queried
     * @return array
     */
    public static function filterUsable(array $usables, array $queried): array
    {
        return array_reduce(
            array_filter(
                array_map(function ($value, $key) use ($usables) {
                    if (in_array($key, $usables)){
                        return [$key => $value];
                    }
                }, $queried, array_keys($queried))
            ),
            'array_merge',
            []
        );
    }
}
