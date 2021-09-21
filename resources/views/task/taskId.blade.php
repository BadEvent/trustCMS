@extends('layouts._layout')
@section('content')
    <input type="hidden" value="{{ $Data = new \App\Models\Data}}">
    <input type="hidden" value="{{ $Organization = new \App\Models\Organization()}}">

    <div class="wrapper">
        <main class="main">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-5">
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

                @if($status['status'] == 1)
                    <div class="alert alert-primary d-flex align-items-center" role="alert">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                             class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img"
                             aria-label="Warning:">
                            <path
                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                        </svg>
                        <div>
                            {{ $status['title'] }}
                        </div>
                    </div>
                @elseif($status['status'] == 0)
                    <div class="alert alert-danger d-flex align-items-center" role="alert">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                             class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img"
                             aria-label="Warning:">
                            <path
                                d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                        </svg>
                        <div>
                            {{ $status['title'] }}
                        </div>
                    </div>
                @elseif($status['status'] == 2)
                @endif

                <div class="row">
                    <div class="col-12 col-lg-9">
                        <div class="page__block">
                            <div class="task__title">
                                Задача #{{ $taskId[0]->id }}: {{ $taskId[0]->title }}
                            </div>
                            <div class="row">
                                <div class="col-8 row-column">
                                    <div class="">
                                        Исполнитель:
                                        <b>{{ $Data->getDataName($taskId[0]->implementer_id)->second_name }}</b>
                                        <b>{{ $Data->getDataName($taskId[0]->implementer_id)->first_name }}</b>
                                    </div>
                                    <div class="">
                                        Дата создания:
                                        <b>{{ date('d.m.y H:i', $taskId[0]->date_add) }}</b>
                                    </div>
                                    <div class="">
                                        Приоритет (1-низкий, 4-высокий):
                                        <b>{{ $taskId[0]->priority }}</b>
                                    </div>
                                    <hr/>

                                    <div class="">
                                        Название организации:
                                        <b>{{ $Organization->getById($taskId[0]->organization_id)->name }}</b>
                                    </div>
                                    <div class="">
                                        Адресс организации:
                                        <b>{{ $Organization->getById($taskId[0]->organization_id)->address }}</b>
                                    </div>
                                    <div class="">
                                        Корпус организации:
                                        <b>{{ $Organization->getById($taskId[0]->organization_id)->housing }}</b>
                                    </div>
                                    <div class="">
                                        Кабинет организации:
                                        <b>{{ $Organization->getById($taskId[0]->organization_id)->office }}</b>
                                    </div>
                                    <hr/>
                                    <div class="task__text">
                                        Описание задачи:
                                        <b>{{ $taskId[0]->data }}</b>
                                    </div>

                                    <hr/>
                                    <div class="">
                                        Завершена с комментарием:
                                        <b>{{ $taskId[0]->comment }}</b>
                                    </div>

                                    <div class="task__buttons">
                                        {!! $taskId[0]->date_end ? '' : '<button class="btn btn-primary me-2 disabled">
                                            Начать выполнение
                                        </button>' !!}
                                        {!! $taskId[0]->date_end ? '' : '<button class="btn btn-success me-2" id="" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal">
                                            Завершить
                                        </button>' !!}

                                        {!! $user->role_id != 1 ? '' : '<a href="'. route('taskEdit', $taskId[0]->id) .'"
                                            class="btn btn-warning">
                                            Редактировать задачу
                                        </a>' !!}

                                    </div>
                                </div>
                                <div class="col-4 task__side_bar">
                                    <div class="">
                                        Крайний срок:
                                        {{ date('d.m.y H:m', $taskId[0]->deadline) }}
                                    </div>
                                    <div class="">
                                        Поручил:
                                        {{ $Data->getDataName($taskId[0]->holder_id)->second_name }}
                                        {{ $Data->getDataName($taskId[0]->holder_id)->first_name }}
                                    </div>
                                    <div>
                                        {{ $taskId[0]->date_end ? 'Завершена: '.date('d.m.y. H:i', $taskId[0]->date_end).' ' : '' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @include('layouts.left_sidebar')
                </div>

                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form method="post" action="{{ route('taskEnd', $taskId[0]->id) }}">
                                {{ csrf_field() }}
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Закрыть задачу</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control"
                                               placeholder="Комментарий закрытия задачи"
                                               name="comment" id="comment">
                                        <input type="hidden" value="{{ $user->id }}" name="implementer_end_id"
                                               id="implementer_end_id">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть
                                    </button>
                                    <button type="submit" class="btn btn-primary" id="save">Закрыть задачу</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>

@endsection

@section('script')
@endsection

