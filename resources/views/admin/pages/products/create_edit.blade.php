@extends('admin.layouts.master')

@section('content')
    <form method='post' enctype="multipart/form-data"  id="jquery-val-form"
          action="{{ isset($item) ? route('admin.products.update', $item->id) : route('admin.products.store') }}">
        <input type="hidden" name="_method" value="{{ isset($item) ? 'PUT' : 'POST' }}">
        @csrf
        <div class="content-header content-header-sm px-4">
            <div class="row">
                <div class="col-md-4">
                    <div class="page-title page-title2">
                        <a href="{{ route('admin.products.index') }}">
                            <i class="fa-solid fa-angle-right"></i>
                            <span>{{ __('products.list') }}</span>
                        </a>
                    </div>
                </div>
                <div class="col-md-4 text-center">
                    <div class="page-title">
                        <span>{{ isset($item) ? $item->name : __('products.actions.new') }}</span>
                    </div>
                </div>
                <div class="col-md-4 text-left">
                    <button type="submit" class="btn btn-sm btn-gradient-green px-2">
                        @if(isset($item))
                            <i class="fa-solid fa-save"></i>
                            {{ __('products.actions.save') }}
                        @else
                            <i class="fa-solid fa-plus"></i>
                            {{ __('products.actions.create')  }}
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
                                <label class="form-label" for="name">{{ __('products.name') }}</label>
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
                            <div class="mb-3 @error('code') is-invalid @enderror">
                                <label class="form-label" for="name">{{ __('products.code') }}</label>
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <i class="fa-solid fa-image"></i>
                                        </div>
                                    </div>
                                    <input class="form-control" name="code" id="code" type="text" value="{{ $item->code ?? old('code') }}">
                                </div>
                                @error('code')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 @error('price') is-invalid @enderror">
                                <label class="form-label" for="name">{{ __('products.price') }}</label>
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <i class="fa-solid fa-image"></i>
                                        </div>
                                    </div>
                                    <input class="form-control" name="price" id="price" type="text" value="{{ $item->price ?? old('price') }}">
                                </div>
                                @error('price')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 @error('description') is-invalid @enderror">
                                <label class="form-label" for="description">{{ __('products.description') }}</label>
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <i class="fa-solid fa-location-dot"></i>
                                        </div>
                                    </div>
                                    <textarea rows="4" class="form-control" name="description" id="description">{{ $item->description ?? old('description') }}</textarea>
                                </div>
                                @error('description')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                </div>
            </div>
        </div>
    </form>
@stop
