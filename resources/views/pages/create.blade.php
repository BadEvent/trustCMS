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
                    <form action="{{ route('pagesCreatePost') }}" method="post">
                        {{ csrf_field() }}
                        <div class="card-body">
                            <div class="form-group">
                                <label>Заголовок <span class="text-danger">*</span></label>
                                <input type="text" name="title" class="form-control" placeholder="Заголовок"/>
                            </div>
                            <div class="form-group">
                                <label>Ссылка на страницу <span class="text-danger">*</span></label>
                                <input type="text" name="link" class="form-control" placeholder="Ссылка на страницу"/>
                            </div>

                            <div class="tinymce">
                                <textarea id="kt-tinymce-4" name="kt-tinymce-4" class="tox-target">
                                </textarea>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary mr-2">Опубликовать</button>
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
    </script>

@endsection