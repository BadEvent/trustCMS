@extends('layouts._layout')

@section('content')
    @php
        $pagesModel = new \App\Models\Pages();
    @endphp
    <!--end::Header-->
    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container">
                <!--begin::Card-->
                <div class="card card-custom gutter-b">
                    <div class="card-header flex-wrap py-3">
                        <div class="card-title">
                            <h3 class="card-label">Страницы</h3>
                        </div>
                    </div>
                    <div class="card-body">
                    {{--                        <form action="{{ route('searchUser') }}" method="post">--}}
                    {{--                            {{ csrf_field() }}--}}
                    {{--                            <div class="row">--}}
                    {{--                                <div class="col-1">--}}
                    {{--                                    <button type="submit" class="btn btn-primary">Поиск</button>--}}
                    {{--                                </div>--}}
                    {{--                                <div class="col-4 mb-5">--}}
                    {{--                                    <input name="searchQuery" class="form-control" type="search"--}}
                    {{--                                           placeholder="Поиск по пользователям"--}}
                    {{--                                           id="example-search-input">--}}
                    {{--                                </div>--}}
                    {{--                            </div>--}}
                    {{--                        </form>--}}
                    <!--begin: Datatable-->
                        <table class="table table-bordered table-checkable" id="kt_datatable">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Название</th>
                                <th>Id автора</th>
                                <th>Статус</th>
                                <th>Ссылка</th>
                                <th>Создано</th>
                                <th>Обновлено</th>
                                <th>а</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($pages as $page)
                                <tr>
                                    <td><a href="{{ route('pagesEdit', $page->id) }}">{{ $page->id }}</a></td>
                                    <td>{{ $page->title }}</td>
                                    <td>{{ \App\Models\User::getByIdStatic($page->author)->login }}</td>
                                    <td>{{ $page->status }}</td>
                                    <td>/{{ $page->link }}</td>
                                    <td>{{ $page->created_at }}</td>
                                    <td>{{ $page->updated_at }}</td>
                                    <td nowrap="nowrap" class="text-white">
                                        {{ route('pagesEdit', $page->id) }}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <!--end: Datatable-->
                    </div>
                </div>
                <!--end::Card-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>
    <!--end::Content-->

@endsection

@section('script')
    <script src="{{ URL::asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ URL::asset('assets/js/pages/crud/datatables/basic/basic.js') }}"></script>
@endsection
