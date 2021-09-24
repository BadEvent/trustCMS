<?php

namespace App\Http\Controllers;

use App\Models\Pages;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $userModel;
    public $pagesModel;
    public $status = [];
    public $user;
    public $breadcrumbs;

    public function __construct()
    {
        $this->userModel = new User();
        $this->pagesModel = new Pages();

        // 1-show (success), 0-show (danger), 2-dont show
        $this->status = [
            'status' => '2',
            'title' => 'Title',
            'message' => 'Empty message'
        ];

        $this->breadcrumbs = [
            [
                'title' => 'Главная',
                'link' => route('index'),
                'active' => false,
            ],
        ];

    }
}
