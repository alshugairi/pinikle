@extends('admin.layouts.master')

@section('content')
    <div class="content-header px-4">
        <div class="row">
            <div class="col-md-2 clearfix">
                <h3 class="page-title mt-2">{{ __('products.plural') }}</h3>
            </div>
            <div class="col-md-4 clearfix"></div>
            <div class="col-md-6 text-left">
                <a href="{{ route('admin.products.create') }}" type="submit" class="btn btn-gradient-green px-3">
                    <i class="fa-solid fa-plus"></i>
                    {{ __('products.actions.create') }}
                </a>
            </div>
        </div>
    </div>
    <div class="px-4">
        <div class="box">
            <div class="table-responsive">
                <table id="dt" class="datatables-ajax table text-fade table-hover nowrap w-100">
                    <thead>
                    <tr>
                        <th>{{ __('products.name') }}</th>
                        <th>{{ __('products.code') }}</th>
                        <th>{{ __('products.price') }}</th>
                        <th width="15%">{{ __('products.options') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop

@push('scripts')
    <script>
        var dt_ajax_table = $('.datatables-ajax');
        var dt_ajax = dt_ajax_table.dataTable({
            processing: true,
            serverSide: true,
            searching: false,
            paging: true,
            info: false,
            ajax: {
                url: "{{ route('admin.products.list') }}",
                data: function (d) {
                    d.name   = $('#filterForm #name').val();
                }
            },
            columns: [
                {data: 'name', name: 'name'},
                {data: 'code', name: 'code'},
                {data: 'price', name: 'price'},
                {data: 'actions',name: 'actions',orderable: false,searchable: false},
            ],
            columnDefs: [{
                "targets": 3,
                "render": function (data, type, row) {
                    var editUrl = '{{ route("admin.products.edit", ":id") }}';
                    editUrl = editUrl.replace(':id', row.id);

                    var html = '<div class="dropdown">';
                    html += '<a class="btn btn-link dropdown-toggle text-turquoise" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                    html += '<i class="fa-solid fa-ellipsis"></i>';
                    html += '</a>';
                    html += '<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">';
                    html += '<a class="dropdown-item" href="'+editUrl+'">{{ __('products.actions.edit') }}</a>';
                    html += '<a class="dropdown-item" href="#">{{ __('products.actions.delete') }}</a>';
                    html += '</div>';
                    html += '</div>';
                    return html;
                }
            }],
        });
        $('.btn_filter').click(function (){
            dt_ajax.DataTable().ajax.reload();
        });
    </script>
@endpush
