<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class LoginController extends Controller
{
    public function login()
    {
        if (Session::get('status') !== null) {
            $this->status = Session::get('status');
        }

        $data['status'] = $this->status;
        return view('auth.login', $data);
    }

    public function loginPost(Request $request)
    {
        $data = $request->all();

        $user = $this->userModel->auth($data);

        if (!empty($user)) {
            $request->session()->flush();
            $request->session()->push('user', $user);
            $this->user = $user;
            return redirect()->route('admin')->with('status', $this->status);
        }

        $this->status = ['status' => 0, 'title' => 'Упс...', 'message' => 'Данные входа не верные'];

        return redirect()->route('login')->with('status', $this->status);
    }

    public function registerPost(Request $request)
    {
        $data = $request->all();
        $user = [
            'login' => $data['fullname'],
            'email' => $data['email'],
            'password' => md5($data['password']),
            'first_name' => $data['firstName'],
            'second_name' => $data['secondName'],
        ];

        if ($this->userModel->create($user)) {
            $this->status = [
                'status' => 1,
                'title' => 'Уииии!',
                'message' => 'Вы успешно зарегистрировались!',
            ];

            return redirect()->route('login')->with('status', $this->status);
        }

        if (!$this->userModel->create($user)) {
            $this->status = [
                'status' => 0,
                'title' => 'Упс...',
                'message' => 'Аккаунт с таким логином или email уже существует!',
            ];

            return redirect()->route('login')->with('status', $this->status);
        }

    }

    public function logout(Request $request)
    {

        $request->session()->flush();

        return redirect()->route('login');
    }
}
