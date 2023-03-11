<?php


namespace App\Libraries;


use App\Models\PageModel;

class Page
{

    public function getPagesMenu()
    {
        $pageModel = new PageModel();
        $pages = $pageModel->select('title, slug')->findAll();
        return view('layouts/incs/page_menu', ['pages' => $pages]);
    }

}
