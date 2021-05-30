<?php


namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class RegisterController extends Controller
{

    public function register()
    {
        $pageTitle = 'Регистрация';

        $data['user'] = $this->user;
        $data['title'] = $pageTitle;
        $data['breadcrumbs'] = [
            [
                'title' => 'Главная',
                'link' => route('index'),
            ],
            [
                'title' => $pageTitle,
                'link' => route('register'),
            ]
        ];

        return view('auth.register', $data);
    }

    public function registerPost(Request $request)
    {
        $userModel = new User;

        $user = $request->all();
        $userData = [
            'login' => $user['login'],
            'password' => $user['password'],
            'email' => $user['email'],
            'role_id' => 4,
        ];

        $userModel->createUser($userData);


    }
}
