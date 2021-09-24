@extends('layouts._layout')

@section('content')

    <!--end::Header-->
    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container">
                <div class="card card-custom">
                    <div class="card-header">
                        <h3 class="card-title">
                            Редактирование страницы
                        </h3>
                        <div class="card-toolbar">
                            <div class="example-tools justify-content-center">
                                <span class="example-toggle" data-toggle="tooltip" title="View code"></span>
                                <span class="example-copy" data-toggle="tooltip" title="Copy code"></span>
                            </div>
                        </div>
                    </div>
                    <!--begin::Form-->
                    <form action="{{ route('pagesEditPost', $page['id']) }}" method="post">
                        <input type="hidden" name="id" value="{{ $page['id'] }}"/>
                        {{ csrf_field() }}
                        <div class="card-body">
                            <div class="form-group">
                                <label>Заголовок <span class="text-danger">*</span></label>
                                <input type="text" name="title" class="form-control" placeholder="Заголовок"
                                       value="{{ $page['title'] }}"/>
                            </div>
                            <div class="form-group">
                                <label>Ссылка на страницу <span class="text-danger">*</span></label>
                                <input type="text" name="link" class="form-control" placeholder="Ссылка на страницу"
                                       value="{{ $page['link'] }}"/>
                            </div>

                            <div class="tinymce">
                                <textarea id="kt-tinymce-4" name="kt-tinymce-4" class="tox-target">
                                    {!! $page['content'] !!}
                                </textarea>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary mr-2">Обновить</button>
                            <button type="reset" class="btn btn-secondary">Сбросить</button>
                        </div>
                    </form>
                    <!--end::Form-->
                </div>
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>
    <!--end::Content-->

@endsection

@section('script')
    <input type="hidden" id="status__status" value="{{ $status['status'] }}">
    <input type="hidden" id="status__title" value="{{ $status['title'] }}">
    <input type="hidden" id="status__message" value="{{ $status['message'] }}">
    <script src="{{ asset('assets/plugins/custom/tinymce/tinymce.bundle.js?v=7.2.8') }}"></script>
    <script src="{{ asset('assets/js/pages/crud/forms/editors/tinymce.js?v=7.2.8') }}"></script>

    <script>
        // Class definition

        var KTTinymce = function () {
            // Private functions
            var demos = function () {
                tinymce.init({
                    force_br_newlines: true,
                    force_p_newlines: false,
                    selector: '#kt-tinymce-4',
                    menubar: false,
                    toolbar: ['styleselect fontselect fontsizeselect',
                        'undo redo | cut copy paste | bold italic | link image | alignleft aligncenter alignright alignjustify',
                        'bullist numlist | outdent indent | blockquote subscript superscript | advlist | autolink | lists charmap | print preview |  code'],
                    plugins: 'advlist autolink link image lists charmap print preview code'
                });
            }

            return {
                // public functions
                init: function () {
                    demos();
                }
            };
        }();

        // Initialization
        jQuery(document).ready(function () {
            KTTinymce.init();
        });


        $(document).ready(function () {
            $('#status__status').val()
            $('#status__title').val()
            $('#status__message').val()

            // show when page load
            if ($('#status__status').val() == 1) {
                toastr.success($('#status__message').val(), $('#status__title').val());
            }
            if ($('#status__status').val() == 0) {
                toastr.error($('#status__message').val(), $('#status__title').val());
            }
            if ($('#status__status').val() == 2) {
            }
        });
    </script>

@endsection
