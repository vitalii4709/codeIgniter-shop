<?php

namespace App\Controllers;


use App\Models\PageModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Page extends BaseController
{
    public function show($slug)
    {
        $pageModel = new PageModel();
        $page = $pageModel->where('slug', $slug)->first();
        if (!$page) {
            throw PageNotFoundException::forPageNotFound();
        }
        return view('page/show', [
            'title' => $page['title'],
            'page' => $page,
        ]);
    }
}
