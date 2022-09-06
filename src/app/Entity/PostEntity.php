<?php

declare(strict_types=1);

namespace App\Entity;

class PostEntity
{
    protected $values = [];

    public function __construct($data)
    {
        $this->values = $data;
    }

    public function __get($key)
    {
        return $this->values[$key];
    }

    public function __set($key, $value)
    {
        $this->values[$key] = $value;
    }
}