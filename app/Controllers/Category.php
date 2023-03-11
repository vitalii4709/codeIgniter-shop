<?php

namespace App\Controllers;


use App\Models\CategoryModel;
use App\Models\ProductModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Category extends BaseController
{

    private $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
    }

    public function show($slug)
    {
        $category = $this->categoryModel->where('slug', $slug)->first();
        if (!$category) {
            throw PageNotFoundException::forPageNotFound();
        }

        $productModel = new ProductModel();
        $products = $productModel->where('category_id', $category['id'])
                ->orderBy($this->getSort())
                ->paginate(6);
        return view('category/show', [
            'title' => $category['title'],
            'category' => $category,
            'products' => $products,
            'pager' => $productModel->pager,
        ]);
    }
    
    protected function getSort(): string
    {
        $sort = $this->request->getGet('sort');
        $sort_values = [
            'title_asc' => 'title ASC',
            'title_desc' => 'title DESC',
            'price_asc' => 'price ASC',
            'price_desc' => 'price DESC',
        ];
        if ($sort && array_key_exists($sort, $sort_values)) {
            $order_by = $sort_values[$sort];
        } else {
            $order_by = 'id ASC';
        }
        return $order_by;
    }
}
