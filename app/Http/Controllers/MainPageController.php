<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;

class MainPageController extends Controller
{
    public function index()
    {

        if (!$this->user) {
            return redirect()->route('login');
        }

        $data['user'] = $this->user;
        return view('index', $data);
    }
}
