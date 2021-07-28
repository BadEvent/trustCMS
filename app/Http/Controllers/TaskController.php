<?php


namespace App\Http\Controllers;


use App\Models\Data;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class TaskController extends Controller
{
    public $task;
    public $pageTitle;
    public $status;

    public function __construct()
    {
        $this->task = new Task;
        $this->pageTitle = 'page';

        // status: 1-true, 0-false, 2-dont show.
        $this->status = [
            'title' => 'Default',
            'status' => 2
        ];
    }

    public function taskDo(Request $request)
    {
        /*************** user auth ******************/
        if (!$request->session()->has('user')) {
            return redirect()->route('login');
        }
        $user = $request->session()->get('user')[0];
        /*************** user auth ******************/

        /**************** status ********************/
        if (!empty(Session::get('status'))) {
            $this->status = Session::get('status');
        }
        /**************** status ********************/

        // page title
        $this->pageTitle = 'Выполняю';

        $tasks = $this->task->getTasksDo($user->id);

        $data['title'] = $this->pageTitle;
        $data['user'] = $user;
        $data['tasks'] = $tasks;
        $data['status'] = $this->status;
        $data['breadcrumbs'] = [
            [
                'title' => 'Главная',
                'link' => route('index'),
                'active' => false,
            ],
            [
                'title' => 'Задачи',
                'link' => route('taskAll'),
                'active' => false,
            ],
            [
                'title' => $this->pageTitle,
                'link' => route('taskDo'),
                'active' => true,
            ]
        ];
        return view('task.do', $data);
    }

    public function taskAll(Request $request)
    {
        /*************** user auth ******************/
        if (!$request->session()->has('user')) {
            return redirect()->route('login');
        }
        $user = $request->session()->get('user')[0];
        if ($user->role_id != 1 || $user->role_id != 2) {
            $this->status = [
                'title' => 'У вас нет доступа к этой странице',
                'status' => 0,
            ];
            return redirect()->back()->with('status', $this->status);
        }
        /*************** user auth ******************/

        /**************** status ********************/
        if (!empty(Session::get('status'))) {
            $this->status = Session::get('status');
        }
        /**************** status ********************/

        // page title
        $this->pageTitle = 'Все задачи';

        $tasksAll = $this->task->getTasksAll();

        $data['title'] = $this->pageTitle;
        $data['user'] = $user;
        $data['tasks'] = $tasksAll;
        $data['status'] = $this->status;
        $data['breadcrumbs'] = [
            [
                'title' => 'Главная',
                'link' => route('index'),
                'active' => false,
            ],
            [
                'title' => $this->pageTitle,
                'link' => route('taskAll'),
                'active' => true,
            ],
        ];

        return view('task.all', $data);
    }

    public function taskId($id, Request $request)
    {
        /*************** user auth ******************/
        if (!$request->session()->has('user')) {
            return redirect()->route('login');
        }
        $user = $request->session()->get('user')[0];
        /*************** user auth ******************/

        /**************** status ********************/
        if (!empty(Session::get('status'))) {
            $this->status = Session::get('status');
        }
        /**************** status ********************/

        // page title
        $this->pageTitle = 'Задача';


        $taskId = $this->task->getTaskById($id);

        $data['title'] = $this->pageTitle;
        $data['user'] = $user;
        $data['taskId'] = $taskId;
        $data['status'] = $this->status;
        $data['breadcrumbs'] = [
            [
                'title' => 'Главная',
                'link' => route('index'),
                'active' => false,
            ],
            [
                'title' => $this->pageTitle,
                'link' => route('taskAll'),
                'active' => true,
            ],
        ];
        return view('task.taskId', $data);
    }

}
