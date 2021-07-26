<?php


namespace App\Http\Controllers;


use App\Models\Data;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;


class TaskController extends Controller
{
    public function taskDo(Request $request)
    {
        /*************** user auth ******************/
        if (!$request->session()->has('user')) {
            return redirect()->route('login');
        }
        $user = $request->session()->get('user')[0];

        /*************** user auth ******************/
        $Task = new Task;

        $pageTitle = 'Выполняю';

        $tasks = $Task->getTasksDo($user->id);

        $data['title'] = $pageTitle;
        $data['user'] = $user;
        $data['tasks'] = $tasks;
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
                'title' => $pageTitle,
                'link' => route('taskDo'),
                'active' => true,
            ]
        ];
        return view('task.do', $data);
    }

}
