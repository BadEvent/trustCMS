@extends('layouts._layout')
@section('content')

    <div class="wrapper">
        <main class="main">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        @foreach($breadcrumbs as $breadcrumb)
                            @if(!$breadcrumb['active'])
                                <li class="breadcrumb-item"><a href="{{ $breadcrumb['link'] }}">{{ $breadcrumb['title'] }}</a></li>
                            @else
                                <li class="breadcrumb-item active" aria-current="page">{{ $breadcrumb['title'] }}</li>
                            @endif
                        @endforeach
                    </ol>
                </nav>
                <form method="post">
                    {{ csrf_field() }}
                    <div class="form__wrapper">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Введите свой логин</label>
                            <input type="text" name="login" class="form-control" id="exampleInputEmail1"
                                   aria-describedby="emailHelp">
                            {{--                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>--}}
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Введите свой пароль</label>
                            <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                        </div>
                        <button type="submit" class="btn btn-outline-success">Войти</button>
                        <div class="mt-3">
                            <a href="{{ route('register') }}">Нет аккаунта? Зарегистрируйся!</a>
                        </div>
                    </div>
                </form>


            </div>
        </main>
@endsection
