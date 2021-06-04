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
                @if(isset($status))
                <h1>{{ $status }}</h1>
                @endif
                <form class="form" action="" method="post">
                    {{ csrf_field() }}
                    <div class="form__wrapper">
                        <div class="form__group">
                            <label class="form__label" for="login">
                                Ваш логин <span class="form__required"> *</span>
                            </label>
                            <input class="form__input" name="login" type="text" id="login"
                                   placeholder="Введите свой логин" required>
                        </div>
                        <div class="form__group">
                            <label class="form__label" for="password">
                                Ваш пароль <span class="form__required"> *</span>
                            </label>
                            <input class="form__input" name="password" type="password" id="password"
                                   placeholder="Введите свой пароль" required>
                        </div>
                        <div class="form__group">
                            <label class="form__label" for="email">
                                Ваш email <span class="form__required"> *</span>
                            </label>
                            <input class="form__input" name="email" type="email" id="email"
                                   placeholder="Введите свою почту" required>
                        </div>
                        <div class="form__group">
                            <label class="form__label" for="firstName">
                                Ваше имя <span class="form__required"> *</span>
                            </label>
                            <input class="form__input" name="firstName" type="text" id="firstName"
                                   placeholder="Введите свое имя" required>
                        </div>
                        <div class="form__group">
                            <label class="form__label" for="secondName">
                                Ваша фамилия <span class="form__required"> *</span>
                            </label>
                            <input class="form__input" name="secondName" type="text" id="secondName"
                                   placeholder="Введите свою фамилию" required>
                        </div>
                        <div class="form__group">
                            <label class="form__label" for="phone">
                                Ваш телефон <span class="form__required"> *</span>
                            </label>
                            <input class="form__input" name="phone" type="phone" id="phone"
                                   placeholder="Введите свой телефон" required>
                        </div>
                        <div class="form__group">
                            <label class="form__label" for="organizationName">
                                Название организации <span class="form__required"> *</span>
                            </label>
                            <input class="form__input" name="organizationName" type="text" id="organizationName"
                                   placeholder="Введите название организации" required>
                        </div>
                        <div class="form__group">
                            <label class="form__label" for="address">
                                Адресс организации <span class="form__required"> *</span>
                            </label>
                            <input class="form__input" name="address" type="text" id="address"
                                   placeholder="Введите адресс организации" required>
                        </div>
                        <div class="form__group">
                            <label class="form__label" for="housing">
                                Корпус здания <span class="form__required"></span>
                            </label>
                            <input class="form__input" name="housing" type="text" id="housing"
                                   placeholder="Введите корпус здания">
                        </div>
                        <div class="form__group">
                            <label class="form__label" for="office">
                                Кабинет <span class="form__required"></span>
                            </label>
                            <input class="form__input" name="office" type="text" id="office"
                                   placeholder="Введите кабинет">
                        </div>
                        <div class="form__group">
                            <button class="btn btn-dark from__btn">Зарегистрироваться</button>
                        </div>
                        <a href="{{ route('login') }}">У вас уже есть аккаунт? Войти!</a>

                    </div>
                </form>
            </div>
        </main>
@endsection
