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
        if ($user->group !== 1) {
            return redirect()->route('index');
        }
        /*************** user auth ******************/

        $data['user'] = $user;
        return view('index', $data);
    }
}
