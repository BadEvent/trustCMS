@extends('layouts._layout')
@section('content')
    <input type="hidden" value="{{ $Data = new \App\Models\Data}}">

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
                                Создать задачу
                            </div>
                            <div class="mb-3">
                                <label for="title" class="form-label">Заголовок задачи</label>
                                <input name="title" id="title" type="text" class="form-control" placeholder="Не работает ПК">
                            </div>
                            <div class="mb-3">
                                <label for="data" class="form-label">Описание задачи</label>
                                <textarea id="data" name="data" rows="5" cols="1" class="form-control"></textarea>
                            </div>
                            <div class="mb-3">
{{--                                <label for="implementer" class="form-label">Выберите исполнителя</label>--}}
                                <select name="implementer" id="implementer" class="form-select" aria-label="select">
                                    <option selected>Выберите исполнителя</option>
                                    @foreach($implementers as $implementer)
                                    <option>{{ $implementer }}</option>

                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-3 mt-sm-0 mt-3">
                        <div class="side_bar__block">
                            test
                        </div>
                    </div>
                </div>


                {{--                {{ dd($taskId[0]) }}--}}
            </div>
        </main>

        @endsection

