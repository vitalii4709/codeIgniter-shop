<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductModel;
use App\Models\UserModel;
use App\Models\OrderProductModel;
use App\Models\OrdersModel;

class Cart extends BaseController
{

    private $model;

    public function __construct()
    {
        $this->model = new ProductModel();
    }

    public function add($id)
    {   
        $qty = abs((int)$this->request->getGet('qty'));
        $product = $this->model->where('id', $id)->first();
        if (!$product) {
            return false;
        }
        $this->model->add2Cart($product, $qty);
        if ($this->request->isAJAX()) {
            return view('cart/cart_modal');
        }
        return redirect()->back();
    }
    
    public function show()
    {
        return view('cart/cart_modal');
    }
    
    public function view()
    {
        return view('cart/view', ['title' => 'Checkout']);
    }
    
    public function delete($id)
    {
        $this->model->deleteItemCart($id);
        if ($this->request->isAJAX()) {
            return view('cart/cart_modal');
        }
        return redirect()->back();
    }

    public function clear()
    {
        if (empty($_SESSION['cart'])) {
            return false;
        }
        unset($_SESSION['cart']);
        unset($_SESSION['cart.qty']);
        unset($_SESSION['cart.sum']);
        if ($this->request->isAJAX()) {
            return view('cart/cart_modal');
        }
        return redirect()->back();
    }
    
    public function checkout()
    {
        $data = $this->request->getPost();
        // регистрация пользователя, если не авторизован
        if (!UserModel::checkAuth()) {
            $userModel = new UserModel();
            if (!$user_id = $userModel->insert($data)) {
                return redirect()->route('cart.view')->withInput()->with('errors', $userModel->errors());
            }
        }
        
        // сохраняем заказ
        $data['user_id'] = $user_id ?? $_SESSION['user']['id'];
        $data['total'] = $_SESSION['cart.sum'];
        $orderModel = new OrdersModel();
        if (!$order_id = $orderModel->insert($data)) {
            return redirect()->route('cart.view')->with('falil', 'Ошибка сохранения заказа');
        }
        
        // сохраняем товары заказа
        $order_product_model = new OrderProductModel();
        $order_products = $this->getOrderProducts($order_id);
        if (!$order_product_model->insertBatch($order_products)) {
            return redirect()->route('cart.view')->with('falil', 'Ошибка сохранения заказа');
        }
        
        // отправляем email
        $email = $data['email'] ?? $_SESSION['user']['email'];
        $this->sendEmail($email, $order_id); // user email
        $this->sendEmail(env('ADMIN_EMAIL'), $order_id); // admin email

        // clear cart
        unset($_SESSION['cart']);
        unset($_SESSION['cart.qty']);
        unset($_SESSION['cart.sum']);
        return redirect()->route('cart.view')->with('success', 'Ваш заказ принят');
    }
    
    protected function sendEmail(string $user_email, int $order_id): bool
    {
        $email = \Config\Services::email();

        $email->setFrom('waterland.water@yandex.ru', 'Shop');
        $email->setTo($user_email);

        $email->setSubject("Заказ #{$order_id} на сайте");
        $message = view('cart/email_view', ['order_id' => $order_id]);
        $email->setMessage($message);

        return $email->send();
    }
    
    protected function getOrderProducts(int $order_id): array
    {
        $order_products = [];
        foreach ($_SESSION['cart'] as $id => $item) {
            $order_products[] = [
                'order_id' => $order_id,
                'product_id' => $id,
                'title' => $item['title'],
                'slug' => $item['slug'],
                'price' => $item['price'],
                'qty' => $item['qty'],
            ];
        }
        return $order_products;
    }
}
