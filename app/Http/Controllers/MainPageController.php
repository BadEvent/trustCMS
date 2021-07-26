<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;

class MainPageController extends Controller
{
    public function index(Request $request)
    {
        /*************** user auth ******************/
        if (!$request->session()->has('user')) {
            return redirect()->route('login');
        }
        $user = $request->session()->get('user')[0];
        /*************** user auth ******************/
        $pageTitle = 'Главная';


        $data['title'] = $pageTitle;
        $data['breadcrumbs'] = [
            [
                'title' => 'Главная',
                'link' => route('index'),
                'active' => false,
            ],
            [
                'title' => $pageTitle,
                'link' => route('login'),
                'active' => true,
            ]
        ];

        $data['user'] = $user;
        return view('index', $data);
    }
}
