@extends('layouts._layout')
@section('content')

    <div class="wrapper">
        <main class="main">
            <div class="container">
                <div class="breadcrumbs">
                    @foreach($breadcrumbs as $breadcrumb)
                        @if(!$breadcrumb['active'])
                            <div class="breadcrumbs__list"><a class="breadcrumbs__item"
                                                              href="{{ $breadcrumb['link'] }}">{{ $breadcrumb['title'] }}</a><i
                                    class="fal fa-chevron-right"></i></div>
                        @else
                            <div class="breadcrumbs__list"><a class="breadcrumbs__item breadcrumbs__item-active"
                                                              href="{{ $breadcrumb['link'] }}">{{ $breadcrumb['title'] }}</a>
                            </div>
                        @endif
                    @endforeach
                </div>
                <form class="form" action="" method="post">
                    {{ csrf_field() }}
                    <div class="form__wrapper">
                        <div class="form__group">
                            <label class="form__label" for="login">
                                Ваш логин
                            </label>
                            <input class="form__input" name="login" id="login" type="text" placeholder="Введите свой логин">
                        </div>
                        <div class="form__group">
                            <label class="form__label" for="password">
                                Ваш пароль
                            </label>
                            <input class="form__input" name="password" id="password" type="password" placeholder="Введите свой пароль">
                        </div>
                        <div class="form__group">
                            <button class="btn btn-dark from__btn">Войти</button>
                        </div>
                        <a href="{{ route('register') }}">Нет аккаунта? Зарегистрируйся!</a>

                    </div>
                </form>

            </div>
        </main>
@endsection
