<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    
    protected $table            = 'category';
    protected $allowedFields    = ['title', 'slug', 'description', 'keywords'];

    // Validation
    protected $validationRules      = [
        'title' => 'required',
    ];

    protected $afterInsert    = ['setSlug'];
    
    protected function setSlug(array $data)
    {
        if ($data['id']) {
            $data['data']['slug'] = mb_url_title($data['data']['title'], '-', true) . "-{$data['id']}";
            self::update($data['id'], $data['data']);
        }
    }

}
