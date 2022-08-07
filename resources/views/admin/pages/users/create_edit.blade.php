@extends('admin.layouts.master')

@section('content')
    <form method='post' enctype="multipart/form-data"  id="jquery-val-form"
          action="{{ isset($item) ? route('admin.users.update', $item->id) : route('admin.users.store') }}">
        <input type="hidden" name="_method" value="{{ isset($item) ? 'PUT' : 'POST' }}">
        @csrf
        <div class="content-header content-header-sm px-4">
            <div class="row">
                <div class="col-md-4">
                    <div class="page-title page-title2">
                        <a href="{{ route('admin.users.index') }}">
                            <i class="fa-solid fa-angle-right"></i>
                            <span>{{ __('users.list') }}</span>
                        </a>
                    </div>
                </div>
                <div class="col-md-4 text-center">
                    <div class="page-title">
                        <span>{{ isset($item) ? $item->name : __('users.actions.new') }}</span>
                    </div>
                </div>
                <div class="col-md-4 text-left">
                    <button type="submit" class="btn btn-sm btn-gradient-green px-2">
                        @if(isset($item))
                            <i class="fa-solid fa-save"></i>
                            {{ __('users.actions.save') }}
                        @else
                            <i class="fa-solid fa-plus"></i>
                            {{ __('users.actions.create')  }}
                        @endif
                    </button>
                </div>
            </div>
        </div>
        <div class="px-4">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3 @error('name') is-invalid @enderror">
                                <label class="form-label" for="name">{{ __('users.name') }}</label>
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <i class="fa-solid fa-image"></i>
                                        </div>
                                    </div>
                                    <input class="form-control" name="name" id="name" type="text" value="{{ $item->name ?? old('name') }}">
                                </div>
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 @error('email') is-invalid @enderror">
                                <label class="form-label" for="email">{{ __('users.email') }}</label>
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <i class="fa-solid fa-envelope"></i>
                                        </div>
                                    </div>
                                    <input class="form-control" name="email" id="email" type="email" value="{{ $item->email ?? old('email') }}">
                                </div>
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 @error('password') is-invalid @enderror">
                                <label class="form-label" for="password">{{ __('users.password') }}</label>
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <i class="fa-solid fa-key"></i>
                                        </div>
                                    </div>
                                    <input class="form-control" name="password" id="password" type="password">
                                </div>
                                @error('password')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 @error('password_confirmation') is-invalid @enderror">
                                <label class="form-label" for="password_confirmation">{{ __('users.confirm_password') }}</label>
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <i class="fa-solid fa-key"></i>
                                        </div>
                                    </div>
                                    <input class="form-control" name="password_confirmation" id="password_confirmation" type="password">
                                </div>
                                @error('password_confirmation')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
{{--                            <div class="mb-3 @error('role_id') is-invalid @enderror">--}}
{{--                                <label class="form-label" for="role_id">{{ __('users.role') }}</label>--}}
{{--                                <div class="input-group">--}}
{{--                                    <div class="input-group-append">--}}
{{--                                        <div class="input-group-text">--}}
{{--                                            <i class="fa-solid fa-lock"></i>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <select class="form-control input" name="role_id">--}}
{{--                                        <option value="">{{ __('users.select') }}</option>--}}
{{--                                        @foreach(\Spatie\Permission\Models\Role::all() as $role)--}}
{{--                                            <option value="{{ $role->id }}" {{ in_array($role->id, $itemRoles) ? 'selected' : '' }}>{{ $role->name }}</option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                                @error('role_id')--}}
{{--                                <span class="text-danger">{{ $message }}</span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">

                </div>
            </div>
        </div>
    </form>
@stop
