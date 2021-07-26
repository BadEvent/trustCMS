<?php


namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        /*************** user auth ******************/
        if (!$request->session()->has('user')) {
            $user = null;
        } else {
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
        $userModel = new User;

        $data = $request->all();
        $user = $userModel->authUser($data);

        if (!empty($user[0]) && isset($user)) {
            $request->session()->flush();
            $request->session()->push('user', $user[0]);
            if ($user[0]->group !== 1) {
                return redirect()->route('index');
            } else {
                return redirect()->route('admin');
            }
        }

        return redirect()->route('index');
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect()->route('login');
    }
}
