<?php

namespace App\Models;

class User extends BaseModel
{
    /**
     * @var string
     */
    protected $table = 'users';

    /**
     * @var string[]
     */
    protected $usable = ['id', 'email', 'admin', 'created'];

    /**
     * @var string
     */
    protected $entityClassName = 'UserEntity';

    /**
     * @param int $id
     * @return void|null
     */
    public function getFromCredentials(string $email, string $password)
    {
        $result = $this->db->query(
            "SELECT * FROM {$this->table} WHERE email='{$email}' AND password='" . md5($password) . "' "
        )->fetch(\PDO::FETCH_ASSOC);

        return $result !== false ? $this->return($result) : null;
    }

    /**
     * @param int $id
     * @return void|null
     */
    public function getFromID(string $email, string $password)
    {
        $result = $this->db->query("SELECT * FROM {$this->table} WHERE id='{$id}'")->fetch(\PDO::FETCH_ASSOC);

        return $result !== false ? $this->return($result) : null;
    }

    /**
     * @param int $id
     * @return void|null
     */
    public function getFromToken(string $token)
    {
        $result = $this->db->query("SELECT * FROM {$this->table} WHERE id='{$id}'")->fetch(\PDO::FETCH_ASSOC);

        return $result !== false ? $this->return($result) : null;
    }
}