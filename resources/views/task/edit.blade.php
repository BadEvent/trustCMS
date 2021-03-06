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
                                {{ $title }}
                            </div>
                            <form action="{{ route('taskCreatePost') }}" method="post">
                                {{ csrf_field() }}
                                <input name="holder_id" type="hidden" value="{{ $user->id }}">
                                <div class="mb-3">
                                    <label for="title" class="form-label">?????????????????? ????????????</label>
                                    <input name="title" id="title" type="text" class="form-control"
                                           placeholder="???? ???????????????? ????" value="{{ $task->title }}">
                                </div>
                                <div class="mb-3">
                                    <label for="data" class="form-label">???????????????? ????????????</label>
                                    <textarea id="data" name="data" rows="5" cols="1" class="form-control">
{{ $task->data }}
                                    </textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="implementer" class="form-label">???????????????? ??????????????????????</label>
                                    <select name="implementer" id="implementer" class="form-select" aria-label="select">
                                        <option selected value="{{ $task->implementer_id }}">
                                            {{ \App\Models\Data::getDataNameStatic($task->implementer_id)->first_name }}
                                            {{ \App\Models\Data::getDataNameStatic($task->implementer_id)->second_name  }}
                                        </option>
                                        @foreach($implementers as $implementer)
                                            <option value="{{ $implementer }}">
                                                {{ \App\Models\Data::getDataNameStatic($implementer)->first_name }}
                                                {{ \App\Models\Data::getDataNameStatic($implementer)->second_name  }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="deadline">?????????????? ????????</label>
                                    <input class="form-control" type="date" id="deadline" name="deadline"
                                           value="{{ date('Y-m-d', $task->deadline) }}">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="priority">??????????????????</label>
                                    <select name="priority" id="priority" class="form-select" aria-label="select">
                                        <option selected value="{{ $task->priority }}">{{ $task->priority }}</option>
                                        @for($i = 1; $i<= 4; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="exampleDataList" class="form-label">???????????????? ??????????????????????:</label>
                                    <input class="form-control" name="organizationName" list="datalistOptions"
                                           id="exampleDataList" placeholder="?????????????? ??????????????, ?????????? ?????????? ..."
                                           value="{{ $Organization->getById($task->id)->name }}">
                                    <datalist id="datalistOptions">
                                        @foreach($organizationsName as $organizationName)
                                            <option class="organizationName" value="{{ $organizationName }}">
                                        @endforeach
                                    </datalist>
                                    <input type="hidden"
                                           value="{{ $test = \App\Models\Organization::getAddressByName($organizationsName[0]) }}">

                                </div>
                                <div class="mb-3">
                                    <label for="address" class="form-label">???????????? ??????????????????????:</label>
                                    <input class="form-control" name="address" list="datalistOptionsAddress"
                                           id="address" placeholder="?????????????? ??????????????, ?????????? ?????????? ..."
                                           value="{{ $Organization->getById($task->id)->address }}">
                                    <datalist id="datalistOptionsAddress">
                                        <option class="address" id="addressOption" value="">
                                    </datalist>
                                </div>
                                <div class="mb-3">
                                    <label for="housing" class="form-label">???????????? ????????????:</label>
                                    <input class="form-control" name="housing" list="datalistOptionsHousing"
                                           id="housing" placeholder="?????????????? ??????????????, ?????????? ?????????? ..."
                                           value="{{ $Organization->getById($task->id)->housing }}">
                                    <datalist id="datalistOptionsHousing">
                                        <option class="housing" id="housingOption" value="">
                                    </datalist>
                                </div>
                                <div class="mb-3">
                                    <label for="office" class="form-label">??????????????:</label>
                                    <input class="form-control" name="office" list="datalistOptionsOffice"
                                           id="office" placeholder="?????????????? ??????????????, ?????????? ?????????? ..."
                                           value="{{ $Organization->getById($task->id)->office }}">
                                    <datalist id="datalistOptionsOffice">
                                        <option class="office" id="officeOption" value="">
                                    </datalist>
                                </div>

                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary">??????????????????</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    @include('layouts.left_sidebar')
                </div>


                {{--                {{ dd($taskId[0]) }}--}}
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
                        let housing = document.querySelector('#housing')
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

