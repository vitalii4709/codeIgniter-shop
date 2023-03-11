<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\CategoryModel;
use App\Models\Admin\ProductModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Category extends BaseController
{
    private $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
    }
    
    public function index()
    {
        $categories = $this->categoryModel
            ->select('category.id, category.title, COUNT(product.id) AS cnt')
            ->join('product', 'product.category_id = category.id', 'left')
            ->groupBy('category.id')
            ->orderBy('category.title')
            ->paginate();
        
        return view('admin/category/index', [
            'title' => 'Список категорий',
            'categories' => $categories,
            'pager' => $this->categoryModel->pager,
        ]);
    }
    
    public function new()
    {
        helper('form');
        return view('admin/category/new', ['title' => 'Новая категория']);
    }
    
    public function create()
    {
        if (!$this->categoryModel->insert($this->request->getPost())) {
            session()->setFlashdata('fail', 'Ошибка!');
            return redirect()->route('admin.category.new')->withInput()->with('errors', $this->categoryModel->errors());
        }
        return redirect()->route('admin.category')->with('success', 'Категория добавлена');
    }
    
    public function edit($id)
    {
        helper('form');
        $category = $this->categoryModel->find($id);
        if (!$category) {
            throw PageNotFoundException::forPageNotFound();
        }
        return view('admin/category/edit', [
            'title' => 'Редактирование категории',
            'category' => esc($category),
        ]);
    }

    public function update($id)
    {
        $category = $this->categoryModel->find($id);
        if (!$category) {
            throw PageNotFoundException::forPageNotFound();
        }
        if (!$this->categoryModel->update($id, $this->request->getPost())) {
            session()->setFlashdata('fail', 'Ошибка!');
            return redirect()->route('admin.category.edit', [$id])->withInput()->with('errors', $this->categoryModel->errors());
        }
        return redirect()->route('admin.category.edit', [$id])->with('success', 'Категория сохранена');
    }
    
    public function delete($id)
    {
        $category = $this->categoryModel->find($id);
        if (!$category) {
            throw PageNotFoundException::forPageNotFound();
        }

        $product = new ProductModel();
        $products_cnt = $product->where('category_id', $id)->countAllResults();
        if ($products_cnt) {
            return redirect()->route('admin.category')->with('fail', 'Невозможно удалить: в категории есть товары');
        }
        $this->categoryModel->delete($id);
        return redirect()->route('admin.category')->with('success', 'Категория удалена');
    }
}
