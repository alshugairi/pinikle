@extends('admin.layouts.auth')
@section('content')
    <div class="login-page2">
        <img class="shade-bottom" src="{{ asset('assets/admin') }}/img/ill-bg-shade-bottom.svg">
        <img class="shade" src="{{ asset('assets/admin') }}/img/ill-bg-shade.svg">
        <div class="container">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="px-4 mt-4">
                        <div class="login-head bg-dark text-center">
                            <div class="logo m-auto">
                                <img src="{{ asset('assets/admin') }}/img/logo.png" alt=" ">
                            </div>
                        </div>
                        <div class="login-section">
                            <div class="login-form bg-white">
                                <form action="{{ route('admin.postLogin') }}" method="post" class="ajaxform" novalidate="novalidate">
                                    @method('post')
                                    @csrf
                                    <div class="form-group">
                                        <label for="client_email" class="control-label">{{ __('admin.email') }}</label>
                                        <div class="input-group mb-3">
                                            <input type="email" name="email" id="email" class="form-control" placeholder="" autocomplete="off">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-envelope"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="client_password" class="control-label">{{ __('admin.password') }}</label>
                                        <div class="input-group mb-3">
                                            <input type="password" name="password" id="password" class="form-control" placeholder="" autocomplete="off">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-lock"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix">
                                        <div class="float-right">
                                            <div class="checkbox">
                                                <label> {{ __('admin.remember_me') }} <input type="checkbox" value=""></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center my-2">
                                        <button type="submit" class="btn btn-lg btn-gradient-green">
                                            {{ __('admin.login') }}
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
    </div>
@stop
