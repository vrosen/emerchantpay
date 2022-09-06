<?php

namespace App\Models;

use App\Traits\QueryModelTrait;
use Slim\Collection;

abstract class BaseModel
{
    use QueryModelTrait;

    /**
     * @var \PDO
     */
    protected $db;

    /**
     * @var array
     */
    protected $usable = [];

    /**
     * @var string
     */
    private $entityNamespace = '\\App\\Entity';

    /**
     * @var string
     */
    protected $entityClassName = '';

    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * @param array $array
     * @return array
     */
    protected function process(array $array): array
    {
        return QueryModelTrait::filterUsable($this->usable, $array);
    }

    /**
     * @param array $array
     * @return void
     */
    protected function return(array $array)
    {
        $entity = "$this->entityNamespace\\$this->entityClassName";

        if (count($array) == count($array, COUNT_RECURSIVE)) {
            return new $entity($this->process($array));
        } else {
            $posts = [];

            foreach ($array as $value) {
                $posts[] = new $entity($this->process($value));
            }

            return new Collection($posts);
        }
    }
}