<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Main extends BaseController
{
    public function index()
    {
        $db = db_connect();
        $orders_cnt = $db->table('orders')->countAll();
        $orders_new_cnt = $db->table('orders')->where('status', 0)->countAllResults();
        $users_cnt = $db->table('user')->countAll();
        $products_cnt = $db->table('product')->countAll();
        
        $year = $this->request->getGet('year') ?? date('Y');
        // SELECT MONTH(created_at) AS month_num, SUM(total) AS total
        // FROM orders WHERE YEAR(created_at) = 2023 GROUP BY month_num
        $sales_cnt = $db->table('orders')
            ->select('MONTH(created_at) AS month_num, SUM(total) AS total')
            ->where('YEAR(created_at)', $year)
            ->groupBy('month_num')->get()->getResultArray();

        if (!empty($sales_cnt)) {
            $labels = implode(',', array_column($sales_cnt, 'month_num'));
            $values = implode(',', array_column($sales_cnt, 'total'));
        }
        
        return view('admin/main/index', [
            'title' => 'Dashboard',
            'orders_cnt' => $orders_cnt,
            'orders_new_cnt' => $orders_new_cnt,
            'users_cnt' => $users_cnt,
            'products_cnt' => $products_cnt,
            'sales_cnt' => $sales_cnt,
            'labels' => $labels ?? '',
            'values' => $values ?? '',
            'year' => $year,
        ]);
    }
}
