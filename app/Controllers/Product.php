<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Exceptions\PageNotFoundException;
use App\Models\ProductModel;

class Product extends BaseController
{
    private $productModel;
    
    public function __construct()
    {
        $this->productModel = new ProductModel();
    }
    
    public function show($slug)
    {
        $product = $this->productModel->select('category.title AS category_title, category.slug AS category_slug, product.*')
            ->where('product.slug', $slug)
            ->join('category', 'product.category_id = category.id')
            ->first();
        if (!$product) {
            throw PageNotFoundException::forPageNotFound();
        }
        return view('product/show', [
            'title' => $product['title'],
            'description' => $product['description'],
            'keywords' => $product['keywords'],
            'product' => $product,
        ]);
    }
}
