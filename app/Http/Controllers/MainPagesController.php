<?php

namespace App\Http\Controllers;

class MainPagesController extends Controller
{

    public function index()
    {
        return redirect()->route('admin');
    }


}
