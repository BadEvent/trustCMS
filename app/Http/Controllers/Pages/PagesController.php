<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Pages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class PagesController extends Controller
{

    public function pagesAll()
    {
        $data['title'] = 'Все страницы';
        $data['user'] = Session::get('user')[0];
        $this->breadcrumbs = [
            [
                'title' => $data['title'],
                'link' => route('pagesAll'),
                'active' => false,
            ],
        ];

        $pages = $this->pagesModel->getPages();

        $data['pages'] = $pages;
        $data['breadcrumbs'] = $this->breadcrumbs;
        return view('pages.all', $data);
    }


    public function pagesCreate()
    {
        $data['title'] = 'Создать страницу';
        $data['user'] = Session::get('user')[0];
        $this->breadcrumbs = [
            [
                'title' => $data['title'],
                'link' => route('pagesCreate'),
                'active' => false,
            ],
        ];


        $data['breadcrumbs'] = $this->breadcrumbs;
        return view('pages.create', $data);
    }

    public function pagesCreatePost(Request $request)
    {
        $data = [
            'title' => $request['title'],
            'link' => $request['link'],
            'content' => $request['kt-tinymce-4'],
            'author' => Session::get('user')[0]->id,
        ];

        Pages::create($data);

        $lastPage = Pages::latest()->first();
        $this->status = ['status' => 1, 'title' => 'Страница создана!', 'message' => 'Вы создали страницу с id ' . $lastPage->id];

        return redirect()->route('pagesEdit', $lastPage->id)->with('status', $this->status);
    }

    public function pagesId($link)
    {
        $page = $this->pagesModel->getByLink($link);

        $data['title'] = $page->title;
        $data['user'] = Session::get('user')[0];
        $this->breadcrumbs = [
            [
                'title' => $data['title'],
                'link' => route('pagesId', $page->id),
                'active' => false,
            ],
        ];

        $data['page'] = $page;
        $data['breadcrumbs'] = $this->breadcrumbs;
        return view('pages.id', $data);
    }

    public function pagesEdit($id)
    {
        if (Session::get('status') !== null) {
            $this->status = Session::get('status');
        }

        $page = $this->pagesModel->getById($id);

        $data['title'] = $page->title;
        $data['user'] = Session::get('user')[0];
        $this->breadcrumbs = [
            [
                'title' => 'Все страницы',
                'link' => route('pagesAll'),
                'active' => true,
            ],
            [
                'title' => $data['title'],
                'link' => route('pagesId', $page->id),
                'active' => false,
            ],
        ];

        $data['page'] = $page;
        $data['breadcrumbs'] = $this->breadcrumbs;
        $data['status'] = $this->status;
        return view('pages.edit', $data);
    }

    public function pagesEditPost(Request $request, $id)
    {
        $fromEdit = $request->all();
        $data = [
            'id' => $id,
            'title' => $fromEdit['title'],
            'link' => $fromEdit['link'],
            'content' => $fromEdit['kt-tinymce-4'],
        ];

        $this->pagesModel->updatePages($data) ? $this->status = ['status' => 1, 'title' => 'Страница обновлена!', 'message' => 'Вы успешно обновили страницу'] : $this->status = ['status' => 0, 'title' => 'Страница не обновлена!', 'message' => 'Произошла какая-то ошибка...'];

        return redirect()->back()->with('status', $this->status);
    }

}
