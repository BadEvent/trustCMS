<?php


namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function logout()
    {
        return view('auth.login');
    }
}
