<?php

namespace App\Libraries;

class Product {
    
    public function productsLoop(array $products)
    {
        return view('layouts/incs/products_loop', ['products' => $products]);
    }
    
}
