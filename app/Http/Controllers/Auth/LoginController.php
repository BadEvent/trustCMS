<?php


namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        /*************** user auth ******************/
        if (!$request->session()->has('user')) {
            $user = null;
        }else{
            return redirect()->back();
        }
        /*************** user auth ******************/
        $pageTitle = 'Авторизация';

        //code here

        $data['title'] = $pageTitle;
        $data['user'] = $user;
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
        return view('auth.login', $data);
    }

    public function loginPost(Request $request)
    {

        $pageTitle = 'Авторизация';
        $status = null;

        //code here

        $data['title'] = $pageTitle;
        $data['user'] = '$this->user';
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
        return view('auth.login', $data)->with('status', $status);

    }

    public function logout()
    {
        return view('auth.login');
    }
}
