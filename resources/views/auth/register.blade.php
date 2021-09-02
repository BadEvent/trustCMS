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
                <div class="container">
                    @if(isset($status) && $status)
                        <div
                            class="alert alert-dismissible fade show {{ $status['type'] == 1 ? 'alert-success' : 'alert-danger' }}"
                            role="alert">
                            {{ $status['text'] }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                </div>
                <form method="post">
                    {{ csrf_field() }}
                    <div class="form__wrapper">
                        <div class="mb-3">
                            <label for="login" class="form-label">Ваш логин:</label>
                            <input type="text" name="login" class="form-control" id="login">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Ваш пароль:</label>
                            <input type="password" name="password" class="form-control" id="password">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Ваш email:</label>
                            <input type="email" name="email" class="form-control" id="email"
                                   aria-describedby="emailHelp">
                            <div id="emailHelp" class="form-text">Мы никогда никому не передадим вашу электронную
                                почту.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Ваше имя:</label>
                            <input type="text" name="firstName" class="form-control" id="name">
                        </div>
                        <div class="mb-3">
                            <label for="secondName" class="form-label">Ваша фамилия:</label>
                            <input type="text" name="secondName" class="form-control" id="secondName">
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Ваш телефон:</label>
                            <input type="tel" name="phone" class="form-control" id="phone">
                        </div>
                        <div class="mb-3">
                            <label for="exampleDataList" class="form-label">Название организации:</label>
                            <input class="form-control" name="organizationName" list="datalistOptions"
                                   id="exampleDataList" placeholder="Начните вводить, чтобы найти ...">
                            <datalist id="datalistOptions">
                                @foreach($organizationsName as $organizationName)
                                    <option class="organizationName" value="{{ $organizationName }}">
                                @endforeach
                            </datalist>
                            <input type="hidden"
                                   value="{{ $test = \App\Models\Organization::getAddressByName($organizationsName[0]) }}">

                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Адресс организации:</label>
                            <input class="form-control" name="address" list="datalistOptionsAddress"
                                   id="address" placeholder="Начните вводить, чтобы найти ...">
                            <datalist id="datalistOptionsAddress">
                                <option class="address" id="addressOption" value="">
                            </datalist>
                        </div>
                        <div class="mb-3">
                            <label for="housing" class="form-label">Корпус здания:</label>
                            <input class="form-control" name="housing" list="datalistOptionsHousing"
                                   id="housing" placeholder="Начните вводить, чтобы найти ...">
                            <datalist id="datalistOptionsHousing">
                                <option class="housing" id="housingOption" value="">
                            </datalist>
                        </div>
                        <div class="mb-3">
                            <label for="office" class="form-label">Кабинет:</label>
                            <input class="form-control" name="office" list="datalistOptionsOffice"
                                   id="office" placeholder="Начните вводить, чтобы найти ...">
                            <datalist id="datalistOptionsOffice">
                                <option class="office" id="officeOption" value="">
                            </datalist>
                        </div>

                        <button type="submit" class="btn btn-outline-success">Регистрация</button>
                        <div class="mt-3">
                            <a href="{{ route('login') }}">Есть аккаунт? Входи!</a>
                        </div>
                    </div>
                </form>
            </div>
        </main>
        @endsection
        @section('script')
            <script>
                $(function () {


                    $('#exampleDataList').on('input', function () {
                        let organizationName = document.querySelector('#exampleDataList').value
                        let address = document.querySelector('#address')
                        let datalistOptionsAddress = document.querySelector('#datalistOptionsAddress')
                        let token = $('meta[name="csrf-token"]').attr('content');
                        $.ajax({
                            url: '{{ route('getAddress') }}',
                            type: "POST",
                            data: {
                                _token: token,
                                organizationName: organizationName
                            },
                            success: function (success) {
                                while (datalistOptionsAddress.firstChild) {
                                    datalistOptionsAddress.removeChild(datalistOptionsAddress.lastChild)
                                }
                                for (let addressVal of success) {
                                    datalistOptionsAddress.appendChild(document.createElement('option')).value = addressVal
                                }
                            },
                            error: function () {
                                address.placeholder = 'false'
                            },
                        });
                    });

                    $('#address').on('input', function () {
                        let organizationName = document.querySelector('#exampleDataList').value
                        let address = document.querySelector('#address')
                        let datalistOptionsAddress = document.querySelector('#datalistOptionsAddress')
                        let datalistOptionsHousing = document.querySelector('#datalistOptionsHousing')
                        let token = $('meta[name="csrf-token"]').attr('content');
                        $.ajax({
                            url: '{{ route('getHousing') }}',
                            type: "POST",
                            data: {
                                _token: token,
                                organizationName: organizationName,
                                organizationAddress: address.value
                            },
                            success: function (success) {
                                while (datalistOptionsHousing.firstChild) {
                                    datalistOptionsHousing.removeChild(datalistOptionsHousing.lastChild)
                                }
                                for (let housingVal of success) {

                                    datalistOptionsHousing.appendChild(document.createElement('option')).value = housingVal
                                }
                            },
                            error: function () {
                                // datalistOptionsHousing.disabled = true
                            },
                        });
                    });

                    $('#housing').on('input', function () {
                        let organizationName = document.querySelector('#exampleDataList').value
                        let housing = document.querySelector('#housing')
                        let datalistOptionsOffice = document.querySelector('#datalistOptionsOffice')

                        let token = $('meta[name="csrf-token"]').attr('content');
                        $.ajax({
                            url: '{{ route('getOffice') }}',
                            type: "POST",
                            data: {
                                _token: token,
                                organizationName: organizationName,
                                organizationHousing: housing.value
                            },
                            success: function (success) {
                                console.log(success)
                                while (datalistOptionsOffice.firstChild) {
                                    datalistOptionsOffice.removeChild(datalistOptionsOffice.lastChild)
                                }
                                for (let officeVal of success) {

                                    datalistOptionsOffice.appendChild(document.createElement('option')).value = officeVal
                                }
                            },
                            error: function () {
                                // datalistOptionsHousing.disabled = true
                            },
                        });
                    });
                });
            </script>
@endsection
