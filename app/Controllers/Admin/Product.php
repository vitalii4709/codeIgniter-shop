<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\ProductModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Product extends BaseController
{
    private $productModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
    }
    
    public function index()
    {
        $category_id = $this->request->getGet('category_id');
        $status = $this->request->getGet('status');
        
        $this->productModel
            ->select('product.id, product.title, product.price, product.status, category.title AS category_title');
        
        if ($category_id) {
            $this->productModel->where('product.category_id', $category_id);
        }

        if ($status == '1' || $status == '0') {
            $this->productModel->where('product.status', $status);
        }
        
        $products = $this->productModel->join('category', 'category.id = product.category_id')
            ->orderBy('product.id ASC')
            ->paginate();

        return view('admin/product/index', [
            'title' => 'Список товаров',
            'products' => $products,
            'pager' => $this->productModel->pager,
            'category_id' => $category_id ?: 0,
            'status' => $status ?? '',
        ]);
    }
    
    public function new()
    {
        helper('form');
        return view('admin/product/new', ['title' => 'Новый товар']);
    }
    
    public function create()
    {
        if (!$this->productModel->insert($this->request->getPost())) {
            session()->setFlashdata('fail', 'Ошибка!');
            return redirect()->route('admin.product.new')->withInput()->with('errors', $this->productModel->errors());
        }
        return redirect()->route('admin.product')->with('success', 'Товар добавлен');
    }
    
    public function edit($id)
    {
        helper('form');
        $product = $this->productModel->find($id);
        if (!$product) {
            throw PageNotFoundException::forPageNotFound();
        }
        return view('admin/product/edit', [
            'title' => 'Редактирование товара',
            'product' => esc($product),
        ]);
    }

    public function update($id)
    {
        $product = $this->productModel->find($id);
        if (!$product) {
            throw PageNotFoundException::forPageNotFound();
        }
        if (!$this->productModel->update($id, $this->request->getPost())) {
            session()->setFlashdata('fail', 'Ошибка!');
            return redirect()->route('admin.product.edit', [$id])->withInput()->with('errors', $this->productModel->errors());
        }
        return redirect()->route('admin.product.edit', [$id])->with('success', 'Товар сохранен');
    }
    
    public function delete($id)
    {
        $product = $this->productModel->find($id);
        if (!$product) {
            throw PageNotFoundException::forPageNotFound();
        }

        $this->productModel->delete($id);
        return redirect()->route('admin.product')->with('success', 'Товар удален');
    }
}
