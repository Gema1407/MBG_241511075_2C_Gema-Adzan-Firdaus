<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'email', 'password', 'role'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = null;

    public function getUserByEmail($email)
    {
        return $this->where('email', $email)->first();
    }
}