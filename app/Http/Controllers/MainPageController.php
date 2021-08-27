<?php


namespace App\Http\Controllers;


use App\Models\Data;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class MainPageController extends Controller
{
    public $task;
    public $pageTitle;
    public $status;
    public $user;
    public $userModel;
    public $data;

    public function __construct(Request $request)
    {
        ($request->session()->get('user')) ? $this->user = $request->session()->get('user')[0] : '';
        $this->task = new Task;
        $this->userModel = new User;
        $this->data = new Data;
        $this->pageTitle = 'page';

        // status: 1-true, 0-false, 2-dont show.
        $this->status = [
            'title' => 'Default',
            'status' => 2
        ];
    }

    public function index(Request $request)
    {
        $pageTitle = 'Главная';


        $data['title'] = $pageTitle;
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

        $data['user'] = $this->user;
        return view('index', $data);
    }
}
