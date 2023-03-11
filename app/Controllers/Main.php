<?php

namespace App\Controllers;
use App\Models\ProductModel;

use App\Controllers\BaseController;

class Main extends BaseController
{
    public function index()
    {
        $productModel = new ProductModel();
        
        $products = $productModel->where('hit', 1)->findAll(6);
        //d($products);
        return view('main/index', [
            'title' => 'Fashion Items Store',
            'products' => $products,
        ]);
    }
}
