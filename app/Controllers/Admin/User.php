<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\UserModel;
use App\Models\Admin\OrdersModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class User extends BaseController
{
    
    private $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }
    
    public function login()
    {
        if (UserModel::isAdmin()) {
            return redirect('admin.main');
        }
        
        if($this->request->getMethod() == 'post') {
            if (!$this->validate('userLogin')) {
                return redirect()->route('admin.login')->with('errors', $this->validator);
            }
            
            // Get user
            $user = $this->userModel->where('email', $this->request->getPost('email'))
                ->where('role', 'admin')
                ->first();
            
            // If !user OR !checkPassword
            if (!$user || !$this->userModel->checkPassword($this->request->getPost('password'), $user['password'])) {
                return redirect()->route('admin.login')->with('fail', 'Incorrect email or password');
            }
            
            // If success validation AND login
            $this->userModel->setProfile($user);
            return redirect()->route('admin.main')->with('success', 'Successful login');
        }
        return view('admin/user/login', ['title' => 'Login']);
    }
    
    public function logout()
    {
        if (UserModel::isAdmin()) {
            session()->destroy();
        }
        return redirect('admin.login');
    }
    
    public function index()
    {
        $users = $this->userModel->paginate();
        return view('admin/user/index', [
            'title' => 'Список пользователей',
            'users' => $users,
            'pager' => $this->userModel->pager,
        ]);
    }
    
    public function new()
    {
        helper('form');
        return view('admin/user/new', ['title' => 'Новый пользователь']);
    }

    public function create()
    {
        if (!$this->userModel->insert($this->request->getPost())) {
            session()->setFlashdata('fail', 'Ошибка!');
            return redirect()->route('admin.user.new')->withInput()->with('errors', $this->userModel->errors());
        }
        return redirect()->route('admin.user')->with('success', 'Пользователь добавлен');
    }
    
    public function edit($id)
    {
        helper('form');
        $user = $this->userModel->find($id);
        if (!$user) {
            throw PageNotFoundException::forPageNotFound();
        }
        return view('admin/user/edit', [
            'title' => 'Редактирование пользователя',
            'user' => esc($user),
        ]);
    }

    public function update($id)
    {
        $data = $this->request->getPost();
        if (empty($data['password'])) {
            unset($data['password']);
        }

        $user = $this->userModel->find($id);
        if (!$user) {
            throw PageNotFoundException::forPageNotFound();
        }
        if (!$this->userModel->update($id, $data)) {
            session()->setFlashdata('fail', 'Ошибка!');
            return redirect()->route('admin.user.edit', [$id])->withInput()->with('errors', $this->userModel->errors());
        }
        return redirect()->route('admin.user.edit', [$id])->with('success', 'Данные пользователя обновлены. Перезайдите, если вы обновляли свои данные.');
    }
    
    public function show($id)
    {
        $user = $this->userModel->where('id', $id)->first();
        if (!$user) {
            throw PageNotFoundException::forPageNotFound();
        }
        $ordersModel = new OrdersModel();
        $orders = $ordersModel->where('user_id', $id)->orderBy('id', 'DESC')->paginate();
        return view('admin/user/show', [
            'title' => 'Профиль пользователя',
            'user' => $user,
            'orders' => $orders,
            'pager' => $ordersModel->pager,
        ]);
    }
}
