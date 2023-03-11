<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = 'product';
    
    public function add2Cart($product, $qty = 1)
    {
        if (isset($_SESSION['cart'][$product['id']])) {
            $_SESSION['cart'][$product['id']]['qty'] += $qty;
        } else {
            $_SESSION['cart'][$product['id']] = [
                'title' => $product['title'],
                'slug' => $product['slug'],
                'price' => $product['price'],
                'qty' => $qty,
                'img' => $product['img'],
            ];
        }

        $_SESSION['cart.qty'] = !empty($_SESSION['cart.qty']) ? $_SESSION['cart.qty'] + $qty : $qty;
        $_SESSION['cart.sum'] = !empty($_SESSION['cart.sum']) ? $_SESSION['cart.sum'] + $qty * $product['price'] : $qty * $product['price'];
    }
    
    public function deleteItemCart($id)
    {
        if (isset($_SESSION['cart'][$id])) {
            $qty_minus = $_SESSION['cart'][$id]['qty'];
            $sum_minus = $_SESSION['cart'][$id]['qty'] * $_SESSION['cart'][$id]['price'];
            $_SESSION['cart.qty'] -= $qty_minus;
            $_SESSION['cart.sum'] -= $sum_minus;
            unset($_SESSION['cart'][$id]);
        }
    }

}


/*Array
(
    [3] => Array
        (
            [qty] => QTY
            [title] => TITLE
            [price] => PRICE
            [img] => IMG
        )
    [5] => Array
        (
            [qty] => QTY
            [title] => TITLE
            [price] => PRICE
            [img] => IMG
        )
    )
    [qty] => QTY,
    [sum] => SUM
*/
    

