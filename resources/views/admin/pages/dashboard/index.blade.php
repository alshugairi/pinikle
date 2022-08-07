@extends('admin.layouts.master')

@section('content')
    <div class="content-header px-4">
        <div class="row">
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon">
                        <i class="fa-solid fa-list"></i>
                    </span>

                    <div class="info-box-content">
                        <span class="info-box-text">{{ __('admin.products_count') }}</span>
                        <span class="info-box-number">{{ $productsCount }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon">
                        <i class="fa-solid fa-users"></i>
                    </span>

                    <div class="info-box-content">
                        <span class="info-box-text">{{ __('admin.users_count') }}</span>
                        <span class="info-box-number">{{ $usersCount }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon">
                        <i class="fa-solid fa-file-invoice"></i>
                    </span>

                    <div class="info-box-content">
                        <span class="info-box-text">{{ __('admin.invoices_count') }}</span>
                        <span class="info-box-number">{{ $invoicesCount }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
        </div>
    </div>
@stop
