<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderProductModel extends Model
{
    protected $table = 'order_product';
    protected $allowedFields = ['order_id', 'product_id', 'title', 'slug', 'price', 'qty'];

}