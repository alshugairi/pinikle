@extends('admin.layouts.master')

@section('content')
    <div class="content-header px-4">
        <div class="row">
            <div class="col-md-2 clearfix">
                <h3 class="page-title mt-2">{{ __('invoices.plural') }}</h3>
            </div>
            <div class="col-md-4 clearfix"></div>
            <div class="col-md-6 text-left">

            </div>
        </div>
    </div>
    <div class="px-4">
        <div class="box">
            <div class="table-responsive">
                <table id="dt" class="datatables-ajax table text-fade table-hover nowrap w-100">
                    <thead>
                    <tr>
                        <th>{{ __('invoices.total') }}</th>
                        <th>{{ __('invoices.created_at') }}</th>
                        <th width="15%">{{ __('invoices.options') }}</th>
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
                url: "{{ route('admin.invoices.list') }}",
                data: function (d) {
                    d.name   = $('#filterForm #name').val();
                }
            },
            columns: [
                {data: 'total', name: 'total'},
                {data: 'created_at', name: 'created_at'},
                {data: 'actions',name: 'actions',orderable: false,searchable: false},
            ],
            columnDefs: [{
                "targets": 2,
                "render": function (data, type, row) {
                    var editUrl = '{{ route("admin.invoices.edit", ":id") }}';
                    editUrl = editUrl.replace(':id', row.id);

                    var html = '<div class="dropdown">';
                    html += '<a class="btn btn-link dropdown-toggle text-turquoise" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                    html += '<i class="fa-solid fa-ellipsis"></i>';
                    html += '</a>';
                    html += '<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">';
                    html += '<a class="dropdown-item" href="'+editUrl+'">{{ __('invoices.actions.edit') }}</a>';
                    html += '<a class="dropdown-item" href="#">{{ __('invoices.actions.delete') }}</a>';
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
