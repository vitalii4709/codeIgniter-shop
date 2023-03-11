<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\OrdersModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Order extends BaseController
{

    private $orderModel;

    public function __construct()
    {
        $this->orderModel = new OrdersModel();
    }

    public function index()
    {
        $orders = $this->orderModel->orderBy('id', 'DESC')->paginate();
        return view('admin/order/index', [
            'title' => 'Список заказов',
            'orders' => $orders,
            'pager' => $this->orderModel->pager,
        ]);
    }
    
    public function edit($id)
    {
        $order = $this->orderModel->select('orders.status, orders.total, orders.note, orders.created_at, orders.updated_at, order_product.product_id, order_product.title, order_product.slug, order_product.price, order_product.qty')
            ->where('orders.id', $id)
            ->join('order_product', 'orders.id = order_product.order_id')
            ->findAll();
        if (!$order) {
            throw PageNotFoundException::forPageNotFound();
        }
        if (!empty($status = $this->request->getGet('status'))) {
            $status = ($status == 'new') ? 0 : 1;
            $this->orderModel->update($id, ['status' => $status]);
            return redirect()->back();
        }
        return view('admin/order/edit', [
            'title' => "Заказ № {$id}",
            'order' => $order,
            'id' => $id,
        ]);
    }
}
