<?php

namespace App\Models;

use CodeIgniter\Model;

class ComicModel extends Model
{
    protected $table = 'comics';
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;
    protected $allowedFields = ['title', 'slug', 'writer', 'publisher', 'cover'];

    public function getComic($slug = false)
    {
        if ($slug == false) {
            return $this->findAll();
        }

        return $this->where(['slug' => $slug])->first();
    }
}
