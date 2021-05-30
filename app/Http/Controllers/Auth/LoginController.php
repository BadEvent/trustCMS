<?php


namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login()
    {

        $data['user'] = $this->user;
        return view('auth.login', $data);
    }

    public function logout()
    {
        return view('auth.login');
    }
}
