@extends('layouts._layout')
@section('content')

    <div class="wrapper">
        <main class="main">
            <div class="container">
                <form class="form" action="" method="post">
                    <div class="form__wrapper">
                        <div class="form__group">
                            <label class="form__label" for="login">
                                Ваш логин
                            </label>
                            <input class="form__input" id="login" type="text" placeholder="Введите свой логин">
                        </div>
                        <div class="form__group">
                            <label class="form__label" for="password">
                                Ваш логин
                            </label>
                            <input class="form__input" id="password" type="password" placeholder="Введите свой пароль">
                        </div>
                        <div class="form__group">
                            <label class="form__label" for="email">
                                Ваш логин
                            </label>
                            <input class="form__input" id="email" type="email" placeholder="Введите свою почту">
                        </div>
                        <div class="form__group">
                            <button class="btn btn-dark from__btn">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </main>
@endsection
