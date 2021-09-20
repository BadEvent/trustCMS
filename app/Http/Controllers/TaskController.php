<?php


namespace App\Http\Controllers;

use App\Http\Expansion\ExpansionClass;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class TaskController extends Controller
{

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
//        dd($test);

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
                'title' => 'Все задачи',
                'link' => route('taskAll'),
                'active' => false,
            ],
            [
                'title' => 'Ваши задачи',
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

        $data['organizationsName'] = $this->organization::groupBy('name')->pluck('name');
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

    public function taskCreatePost(Request $request)
    {
        $data = $request->all();

        $organization_id = $this->organizationFunc($data);

        // перевод даты из строки "d/m/Y" (01/01/2000) в дату
        $date = DateTime::createFromFormat('Y-m-d', $data['deadline'])->format('d-m-Y H:i');
        // перевод даты в timestamp
        $date = Carbon::parse($date)->timestamp;

        $taskData = [
            'title' => $data['title'],
            'date_add' => Carbon::now()->timestamp,
            'deadline' => $date,
            'holder_id' => $data['holder_id'],
            'implementer_id' => $data['implementer'],
            'organization_id' => $organization_id,
            'data' => $data['data'],
            'priority' => $data['priority'],

        ];

        $this->task->createTask($taskData);

    }

    public function taskEnd($id, Request $request)
    {

        dd($request);
    }

}
