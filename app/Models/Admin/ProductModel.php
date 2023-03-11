<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = 'product';
    protected $allowedFields = ['category_id', 'title', 'slug', 'price', 'status', 'hit', 'img', 'gallery', 'excerpt', 'content', 'description', 'keywords'];
    
    protected $validationRules = [
        'title' => 'required',
        'category_id' => 'integer',
        'price' => 'numeric',
        'excerpt' => 'required',
    ];
    
    protected $beforeInsert = ['setGellery', 'setStatus'];
    protected $afterInsert = ['setSlug'];
    protected $beforeUpdate = ['setStatus', 'setGellery', 'setImage'];
    
    protected function setSlug(array $data)
    {
        if ($data['id']) {
            $data['data']['slug'] = mb_url_title($data['data']['title'], '-', true) . "-{$data['id']}";
            self::update($data['id'], $data['data']);
        }
    }
    
    protected function setGellery(array $data)
    {
        if (isset($data['data']['gallery'])) {
            $data['data']['gallery'] = implode(',', (array)$data['data']['gallery']);
        } else {
            $data['data']['gallery'] = '';
        }
        return $data;
    }
    
    protected function setStatus(array $data)
    {
        if (isset($data['data']['status'])) {
            $data['data']['status'] = $data['data']['status'] ? 1 : 0;
        } else {
            $data['data']['status'] = 0;
        }

        if (isset($data['data']['hit'])) {
            $data['data']['hit'] = $data['data']['hit'] ? 1 : 0;
        } else {
            $data['data']['hit'] = 0;
        }
        return $data;
    }
    
    protected function setImage(array $data)
    {
        $data['data']['img'] = $data['data']['img'] ?? env('NO_IMAGE');
        return $data;
    }
}
