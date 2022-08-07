<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pinikle</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/admin') }}/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/admin') }}/css/adminlte.min.css">
    <link rel="stylesheet" media="all" type="text/css" href="http://code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css" />
    <link rel="stylesheet" href="{{ asset('assets/admin') }}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('assets/admin') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('assets/admin') }}/plugins/tables/datatable/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="{{ asset('assets/admin') }}/plugins/tables/datatable/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('assets/admin') }}/plugins/apexcharts/apexcharts.css">
    <link rel="stylesheet" href="{{ asset('assets/admin') }}/plugins/timepicker/jquery-ui-timepicker-addon.min.css">
    <link rel="stylesheet" href="{{ asset('assets/admin') }}/css/custom.css">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@600;700;900&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/admin') }}/css/rtl.css">
    @stack('styles')
</head>
<body class="sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
    <!-- Navbar -->
    <nav class=" navbar navbar-expand">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link d-in" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.home') }}" class="d-inline-block">
                    <img class="mt-2" src="{{ asset('assets/admin') }}/img/logo.png" height="25">
                </a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item" style="display:none">
                <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                    <i class="fas fa-search"></i>
                </a>
                <div class="navbar-search-block">
                    <form class="form-inline">
                        <div class="input-group input-group-sm">
                            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                            <div class="input-group-append">
                                <button class="btn btn-navbar" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </li>
            <!-- Notifications Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="fa-solid fa-language"></i>
                    {{ LaravelLocalization::getCurrentLocale() }}
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                            {{ $properties['native'] }}
                        </a>
                    @endforeach
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-user"></i>
                    {{ auth()->user()->name ?? '' }}
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();" class="dropdown-item">
                        <i class="fas fa-sign-out-alt"></i>&nbsp;
                        {{ __('admin.logout') }}</a>
                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </nav>

    <!-- Main Sidebar Container -->
    @include('admin.partials.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <!-- Main content -->
        <section class="content" style="padding-bottom: 18px;">
            @include('flash::message')
            @yield('content')
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
        <strong class="text-center">طوره <a href="https://barmagiat.co">برمجيات</a></strong>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
    <!-- Modal -->
    <div class="modal fade text-start" id="modalDelete" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true">
        <div class="modal-dialog">
            <form id="deleteForm" method="post" action="">
                <input type="hidden" name="_method" value="DELETE">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel1">{{ __('admin.dialogs.delete.title') }}</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        {{ __('admin.dialogs.delete.info') }}
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-sm btn-danger">{{ __('admin.dialogs.delete.confirm') }}</button>
                        <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">{{ __('admin.dialogs.delete.cancel') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('assets/admin') }}/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('assets/admin') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/ui/1.11.0/jquery-ui.min.js"></script>
{{--<script src="{{ asset('assets/admin') }}/plugins/jquery-ui/jquery-ui.min.js"></script>--}}
<script src="{{ asset('assets/admin') }}/plugins/tables/datatable/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('assets/admin') }}/plugins/tables/datatable/js/datatables.buttons.min.js"></script>
<script src="{{ asset('assets/admin') }}/plugins/tables/datatable/js/dataTables.bootstrap5.min.js"></script>
<script src="{{ asset('assets/admin') }}/plugins/tables/datatable/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('assets/admin') }}/plugins/tables/datatable/js/responsive.bootstrap4.js"></script>
<script src="{{ asset('assets/admin') }}/plugins/select2/js/select2.full.min.js"></script>
<script src="{{ asset('assets/admin') }}/plugins/chart.js/Chart.min.js"></script>
<script src="{{ asset('assets/admin') }}/plugins/moment/moment.min.js"></script>
<script src="{{ asset('assets/admin') }}/js/jquery-sortable.js"></script>
<script src="{{ asset('assets/admin') }}/plugins/moment/moment.min.js"></script>
<script src="{{ asset('public/assets/admin') }}/plugins/inputmask/jquery.inputmask.min.js"></script>
<script src="{{ asset('public/assets/admin') }}/plugins/timepicker/jquery-ui-timepicker-addon.min.js"></script>

<!-- AdminLTE App -->
<script src="{{ asset('public/assets/admin') }}/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('public/assets/admin') }}/js/demo.js"></script>
{{--<script src="{{ asset('public/assets/admin') }}/plugins/ckeditor/ckeditor.js"></script>--}}
<script>
    $(function (){
        $('body').on('click', '.select_all', function(){
            $('input.row_check:checkbox').not(this).prop('checked', this.checked);
            var c = $('input.row_check:checkbox:checked').length;
            $('.rows_count').html(c);
        })
        //$('div.alert').not('.alert-important').delay(3000).fadeOut(350);

        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
        $('.ajax_select2').select2({
            dir: "rtl",
            placeholder: "{{ __('admin.select') }}",
            ajax: {
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {results: data};
                },
                cache: true
            }
        });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('body').on('click', '.delete_item', function (){
            var url= $(this).attr('data-url');
            $('#deleteForm').attr('action', url)
            $('#modalDelete').modal('show')
            return false;
        })
        // CKEDITOR.editorConfig = function( config ) {
        //     config.language = 'es';
        //     config.uiColor = '#F7B42C';
        //     config.height = 400;
        //     config.toolbarCanCollapse = true;
        //     config.extraPlugins = 'wordcount';
        //     config.wordcount = {
        //
        //         // Whether or not you want to show the Word Count
        //         showWordCount: true,
        //
        //         // Whether or not you want to show the Char Count
        //         showCharCount: false,
        //
        //         // Maximum allowed Word Count
        //         maxWordCount: 4,
        //
        //         // Maximum allowed Char Count
        //         maxCharCount: 10
        //     };
        // };
        // CKEDITOR.replace( 'editor', {
        //     height:400,
        //     rtl:true,
        //     toolbarCanCollapse:true,
        //     extraPlugins:'wordcount',
        //     wordcount: {
        //         showWordCount: true,
        //         showCharCount: true,
        //     },
        // });
        // CKEDITOR.dataProcessor.htmlFilter.addRules(
        //     {
        //         elements :
        //             {
        //                 a : function( element )
        //                 {
        //                     if ( !element.attributes.rel )
        //                         element.attributes.rel = 'nofollow';
        //                 }
        //             }
        //     });

        $('#uploadImg').change(function (){
            const [file] = $('#uploadImg')[0].files;
            if (file) {
                imagePreview.src=URL.createObjectURL(file)
            }
        })
        /*$(document).on('change', '#name', function(){
            var $this = $(this);
            var seo_title = $('#seo_title').val();
            if(seo_title == '') {
                $('#seo_title').val($this.val());
            }
        })
        $(document).on('change', '#description', function(){
            var $this = $(this);
            var seo_description = $('#seo_description').val();
            if(seo_description == '') {
                $('#seo_title').val($this.val());
            }
        })*/
        $(document).on('change', '#slug', function(){
            var $this = $(this);
            $this.val(convertToSlug($this.val()));
        })
        $('.datetimepicker').datetimepicker({
            dateFormat: 'yy-mm-dd',
            defaultValue: '2016/11/08 06:07:08',
        })
        function convertToSlug(Text) {
            return Text.toLowerCase()
                .replace(/ /g, '-');
        }
    })
</script>
@stack('scripts')
</body>
</html>
