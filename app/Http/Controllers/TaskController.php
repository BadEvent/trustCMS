<?php


namespace App\Http\Controllers;


use App\Http\Expansion\ExpansionClass;
use App\Models\Data;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class TaskController extends Controller
{
    public $task;
    public $pageTitle;
    public $status;
    public $user;
    public $userModel;
    public $data;
    public $expansion;

    public function __construct(Request $request)
    {
        ($request->session()->get('user')) ? $this->user = $request->session()->get('user')[0] : '';
        $this->task = new Task;
        $this->userModel = new User;
        $this->data = new Data;
        $this->expansion = new ExpansionClass();
        $this->pageTitle = 'page';

        // status: 1-true, 0-false, 2-dont show.
        $this->status = [
            'title' => 'Default',
            'status' => 2
        ];
    }

    public function taskDo()
    {
        /**************** status ********************/
        if (!empty(Session::get('status'))) {
            $this->status = Session::get('status');
        }
        /**************** status ********************/

        // page title
        $this->pageTitle = 'Выполняю';

        $tasks = $this->task->getTasksDo($this->user->id);

        $data['title'] = $this->pageTitle;
        $data['user'] = $this->user;
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

    public function taskAll()
    {
        /**************** status ********************/
        if (!empty(Session::get('status'))) {
            $this->status = Session::get('status');
        }
        /**************** status ********************/
        if (!$this->expansion->adminValidation($this->user->role_id)) {
            $this->status = [
                'title' => 'Вам запрещено просматривать эту страницу',
                'status' => 0,
            ];
            return redirect()->back()->with('status', $this->status);
        }

        // page title
        $this->pageTitle = 'Все задачи';

        $tasksAll = $this->task->getTasksAll();

        $data['title'] = $this->pageTitle;
        $data['user'] = $this->user;
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

    public function taskId($id)
    {
        /**************** status ********************/
        if (!empty(Session::get('status'))) {
            $this->status = Session::get('status');
        }
        /**************** status ********************/

        // page title
        $this->pageTitle = 'Задача';


        $taskId = $this->task->getTaskById($id);

        $test = $this->userModel::find($this->user->id);

        $data['title'] = $this->pageTitle;
        $data['user'] = $this->user;
        $data['taskId'] = $taskId;
        $data['status'] = $this->status;
        $data['breadcrumbs'] = [
            [
                'title' => 'Главная',
                'link' => route('index'),
                'active' => false,
            ],
            [
                'title' => 'Задачи',
                'link' => route('taskDo'),
                'active' => false,
            ],
            [
                'title' => $this->pageTitle . ' #' . $id,
                'link' => route('taskAll'),
                'active' => true,
            ],
        ];
        return view('task.taskId', $data);
    }

    public function taskCreate()
    {
        /**************** status ********************/
        if (!empty(Session::get('status'))) {
            $this->status = Session::get('status');
        }
        /**************** status ********************/

        // page title
        $this->pageTitle = 'Задача';

        $implementers = $this->userModel->getImplementer();

        $data['title'] = $this->pageTitle;
        $data['user'] = $this->user;
        $data['status'] = $this->status;
        $data['breadcrumbs'] = [
            [
                'title' => 'Главная',
                'link' => route('index'),
                'active' => false,
            ],
            [
                'title' => 'Ваши задачи',
                'link' => route('taskDo'),
                'active' => false,
            ],
            [
                'title' => $this->pageTitle,
                'link' => route('taskDo'),
                'active' => true,
            ],
        ];
        $data['implementers'] = $implementers;

        return view('task.taskCreate', $data);
    }

    public function taskEnd($id, Request $request)
    {

        dd($request);
    }

}
