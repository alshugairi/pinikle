@extends('front.layouts.master')

@section('content')
    <!-- Header-->
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">{{ __('front.cart') }}</h1>
                <p class="lead fw-normal text-white-50 mb-0"></p>
            </div>
        </div>
    </header>
    <!-- Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            @include('flash::message')
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered m-0">
                        <thead>
                        <tr>
                            <!-- Set columns width -->
                            <th class="text-center py-3 px-4" style="min-width: 400px;">{{ __('front.product') }}</th>
                            <th class="text-right py-3 px-4" style="width: 100px;">{{ __('front.price') }}</th>
                            <th class="text-center py-3 px-4" style="width: 120px;">{{ __('front.quantity') }}</th>
                            <th class="text-right py-3 px-4" style="width: 100px;">{{ __('front.total') }}</th>
                            <th class="text-center align-middle py-3 px-0" style="width: 40px;"><a href="#" class="shop-tooltip float-none text-light" title="" data-original-title="Clear cart"><i class="ino ion-md-trash"></i></a></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $item)
                        <tr>
                            <td class="p-4">
                                <a href="{{ route('single_product', $item->id) }}" class="d-block text-dark">{{ $item->name }}</a>
                            </td>
                            <td class="text-right font-weight-semibold align-middle p-4">${{ $item->price }}</td>
                            <td class="align-middle p-4">{{ $item->quantity }}</td>
                            <td class="text-right font-weight-semibold align-middle p-4">${{ $item->price * $item->quantity }}</td>
                            <td class="text-center align-middle px-0">
                                <form action="{{ route('cart.delete', $item->id) }}" method="get">
                                    <button type="submit"  class="shop-tooltip close float-none text-danger" href="#" style="border: none"> {{ __('front.remove_from_cart') }}</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
                <!-- / Shopping cart table -->

                <div class="d-flex flex-wrap justify-content-between align-items-center pb-4">
                    <div class="d-flex">
                        <div class="text-right mt-4">
                            <label class="text-muted font-weight-normal m-0">{{ __('front.total') }}</label>
                            <div class="text-large"><strong>${{ \Cart::getTotal() }}</strong></div>
                        </div>
                    </div>
                </div>
                @if(\Cart::getTotal() > 0)
                <div class="float-right">
                    <a href="{{ route('home') }}" class="btn btn-lg btn-default md-btn-flat mt-2 mr-3">{{ __('front.back_to_shop') }}</a>
                    <a href="{{ route('checkout') }}" class="btn btn-lg btn-primary mt-2">{{ __('front.checkout') }}</a>
                </div>
                @endif
            </div>
        </div>
    </section>
@endsection
