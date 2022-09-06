<?php

namespace App\Interfaces;

interface ResourceInterface
{
    public function toArray(object $data): array;

    public function append(array $array): array;
}