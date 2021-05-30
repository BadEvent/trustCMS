<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets/css/style.min.css') }}?v1.0.1.3">
    <title>{{ $title }}</title>
</head>
<body>

<header class="header">
    <div class="header__container">
        <div class="logo col-8 col-md-auto ">Trust TMS</div>
        @if(!is_null($user))
            <div class="header__menu ">
                <div class="menu__icon">
                    <span></span>
                </div>
                <nav class="menu">
                    <ul class="menu__list">
                        <li class="menu__item"><a href="{{ route('index') }}" class="menu__item-link">Главная</a></li>
                        <li class="menu__item">
                            <a href="#" class="menu__item-link">Задачи</a>
                            <i class="fal fa-sort-down menu__arrow"></i>
                            <ul class="menu__sub_list">
                                <li class="menu__sub_item">
                                    <a href="#" class="menu__sub_item-link">Все</a>
                                </li>
                                <li class="menu__sub_item">
                                    <a href="#" class="menu__sub_item-link">Выполняю</a>
                                </li>
                                <li class="menu__sub_item">
                                    <a href="#" class="menu__sub_item-link">Помогаю</a>
                                </li>
                            </ul>
                        </li>
                        <li class="menu__item"><a href="#" class="menu__item-link">Редактор</a></li>
                        <li class="menu__item"><a href="#" class="menu__item-link">Редактор1</a></li>
                        <li class="menu__item">
                            <a href="#" class="menu__item-link">Редактор2</a>
                            <i class="fal fa-sort-down menu__arrow"></i>
                            <ul class="menu__sub_list">
                                <li class="menu__sub_item">
                                    <a href="#" class="menu__sub_item-link">Все</a>
                                </li>
                                <li class="menu__sub_item">
                                    <a href="#" class="menu__sub_item-link">Выполняю</a>
                                </li>
                                <li class="menu__sub_item">
                                    <a href="#" class="menu__sub_item-link">Помогаю</a>
                                </li>
                            </ul>
                        </li>
                        <li class="menu__item"><a href="#" class="menu__item-link">Редактор Редактор</a></li>
                    </ul>
                </nav>
            </div>
        @endif
        <div class=" menu__login_control-block">
            @if(is_null($user))
                <a class="menu__login_control" href="{{ route('login') }}">
                    <i class="fal fa-lg fa-user"></i>
                </a>
            @endif
            @if(!is_null($user))
                <a class="menu__login_control" href="{{ route('logout') }}">
                    <i class="fal fa-lg fa-sign-out"></i>
                </a>
            @endif
        </div>

    </div>
</header>
