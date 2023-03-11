<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\OrdersModel;

class User extends BaseController
{

    private $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }
    
    public function signup()
    {
        if (UserModel::checkAuth()) {
            return redirect('main.index');
        }

        if ($this->request->getMethod() == 'post') {
            if (!$this->userModel->insert($this->request->getPost())) {
                return redirect()->route('user.signup')->with('errors', $this->userModel->errors());
            } else {
                return redirect()->route('user.login')->with('success', 'You have successfully registered. You can log in.');
            }
        }
        return view('user/signup', ['title' => 'Registr']);
    }

    public function login()
    {
        if (UserModel::checkAuth()) {
            return redirect('main.index');
        }

        if ($this->request->getMethod() == 'post') {
            if (!$this->validate('userLogin')) {
                return redirect()->route('user.login')->with('errors', $this->validator->getErrors());
            }

            // Get user
            $user = $this->userModel->where('email', $this->request->getPost('email'))->first();

            // If !user OR !checkPassword
            if (!$user || !$this->userModel->checkPassword($this->request->getPost('password'), $user['password'])) {
                return redirect()->route('user.login')->with('fail', 'Incorrect email or password');
            }

            // If success validation AND login
            $this->userModel->setProfile($user);
            return redirect()->route('main.index');
        }
        return view('user/login', ['title' => 'Login']);
    }

    public function logout()
    {
        if (UserModel::checkAuth()) {
            session()->destroy();
        }
        return redirect('user.login');
    }
    
    public function cabinet()
    {
        if (!UserModel::checkAuth()) {
            return redirect('user.login');
        }
        return view('user/cabinet', ['title' => 'Личный кабинет']);
    }

    public function orders()
    {
        if (!UserModel::checkAuth()) {
            return redirect('user.login');
        }

        $orderModel = new OrdersModel();
        $orders = $orderModel->where('user_id', $_SESSION['user']['id'])->orderBy('id', 'DESC')->paginate();

        return view('user/orders', [
            'title' => 'Список заказов',
            'orders' => $orders,
            'pager' => $orderModel->pager,
        ]);
    }
    
    public function order($id)
    {
        if (!UserModel::checkAuth()) {
            return redirect('user.login');
        }

        $orderModel = new OrdersModel();
        $order = $orderModel->select('orders.status, orders.total, orders.note, orders.created_at, orders.updated_at, order_product.title, order_product.slug, order_product.price, order_product.qty')
            ->where('orders.id', $id)
            ->join('order_product', 'orders.id = order_product.order_id')
            ->findAll();

        if (!$order) {
            throw PageNotFoundException::forPageNotFound();
        }

        return view('user/order', [
            'title' => "Заказ № {$id}",
            'order' => $order,
            'id' => $id,
        ]);
    }
    
    public function credentials()
    {
        if (!UserModel::checkAuth()) {
            return redirect('user.login');
        }

        if ($this->request->getMethod() == 'post') {
            $data = $this->request->getPost();
            $data['id'] = $_SESSION['user']['id'];
            if (empty($data['password'])) {
                unset($data['password']);
            }

            if (!$this->userModel->update($data['id'], $data)) {
                return redirect()->route('user.credentials')->with('errors', $this->userModel->errors());
            } else {
                $user = $this->userModel->where('id', $_SESSION['user']['id'])->first();
                $this->userModel->setProfile($user);
                return redirect()->route('user.credentials')->with('success', 'Профиль обновлен');
            }
        }

        return view('user/credentials', ['title' => 'Учетные данные']);
    }

}
