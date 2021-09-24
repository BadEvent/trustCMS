<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function index()
    {
        $data['title'] = 'Панель администратора';
        $this->breadcrumbs = [
            [
                'title' => $data['title'],
                'link' => route('index'),
                'active' => false,
            ],
        ];


        $data['breadcrumbs'] = $this->breadcrumbs;
        $data['user'] = Session::get('user')[0];

        return view('admin.index', $data);
    }
}
