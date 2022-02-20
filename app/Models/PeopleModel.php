<?php

namespace App\Models;

use CodeIgniter\Model;

class PeopleModel extends Model
{
    protected $table = 'people';
    protected $useTimestamps = true;
    protected $allowedFields = ['name', 'address', 'created_at', 'updated_at'];

    public function search($keyword)
    {
        return $this->table('people')->like('name', $keyword)->orLike('address', $keyword);
    }
}
