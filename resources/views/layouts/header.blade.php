<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.min.css') }}?v1.0.1.3">
    <title>{{ $title }}</title>
</head>
<body>

<header class="header">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Trust 3.0</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav flex-fill mb-2 mb-lg-0">
                    @if($user)
                        <li class="nav-item">
                            <a class="nav-link {{ Request::routeIs('index') ? 'active' : '' }}" aria-current="page"
                               href="{{ route('index') }}">Главная</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle {{ Request::routeIs('taskDo', 'taskHelp', 'taskWatch', 'taskCreate', 'taskAll') ? 'active' : '' }}" href="#" id="navbarDropdown" role="button"
                               data-bs-toggle="dropdown" aria-expanded="false">
                                Задачи
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{ route('taskDo') }}">Делаю</a></li>
                                <li><a class="dropdown-item" href="{{ route('taskHelp') }}">Помогаю</a></li>
                                <li><a class="dropdown-item" href="{{ route('taskWatch') }}">Наблюдаю</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="{{ route('taskCreate') }}">Создать задачу</a></li>
                                <li><a class="dropdown-item" href="{{ route('taskAll') }}">Все задачи</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Редактор</a>
                        </li>
                        <div class="flex-fill text-align-right">
                            <li class="nav-item">
                                <input type="hidden" value="{{ $data = new \App\Models\Data}}">
                                <a class="nav-link" href="{{ route('logout') }}">Выход ({{ $data->getDataName($user->data_id)->first_name }})</a>
                            </li>
                        </div>

                    @else
                        <li class="nav-item">
                            <a class="nav-link {{ Request::routeIs('login') ? 'active' : '' }}"
                               href="{{ route('login') }}">Войти</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::routeIs('register') ? 'active' : '' }}"
                               href="{{ route('register') }}">Регистрация</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</header>
