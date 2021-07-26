@extends('layouts._layout')
@section('content')

    <div class="wrapper">
        <main class="main">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        @foreach($breadcrumbs as $breadcrumb)
                            @if(!$breadcrumb['active'])
                                <li class="breadcrumb-item"><a
                                        href="{{ $breadcrumb['link'] }}">{{ $breadcrumb['title'] }}</a></li>
                            @else
                                <li class="breadcrumb-item active" aria-current="page">{{ $breadcrumb['title'] }}</li>
                            @endif
                        @endforeach
                    </ol>
                </nav>

                <table class="table caption-top">
                    <caption>Лист задач</caption>
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Название</th>
                        <th scope="col">Крайний срок</th>
                        <th scope="col">Постановщик</th>
                    </tr>
                    </thead>
                    <tbody>
                    <input type="hidden" value="{{ $Data = new \App\Models\Data}}">
                    <input type="hidden" value="{{ $User = new \App\Models\User}}">
                    @foreach($tasks as $task)
                        <tr>
                            <th scope="row">{{ $task->id }}</th>
                            <td><a href="{{ $task->id }}">{{ $task->title }}</a></td>
                            <td>{{ date('d.m.Y H:m:s', $task->deadline) }}</td>
                            <td>{{ $Data->getDataName($task->holder_id)->first_name }}
                                ({{ $User->getLoginById($task->holder_id)->login }})
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </main>

@endsection

