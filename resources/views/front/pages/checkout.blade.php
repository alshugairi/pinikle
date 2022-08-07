@extends('front.layouts.master')

@section('content')
    <!-- Header-->
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">{{ __('front.checkout') }}</h1>
                <p class="lead fw-normal text-white-50 mb-0"></p>
            </div>
        </div>
    </header>
    <!-- Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            @include('flash::message')

            <form action="{{ route('checkout.post') }}" method="post">
                @csrf
                <div class="row">
                    <!-- Left -->
                    <div class="col-lg-9">
                        <div class="accordion" id="accordionPayment">
                            <div class="accordion-item mb-3 border">
                                <h2 class="h5 px-4 py-3 accordion-header d-flex justify-content-between align-items-center">
                                    <div class="form-check w-100 collapsed" data-bs-toggle="collapse" data-bs-target="#collapsePP" aria-expanded="false">
                                        <input class="form-check-input" type="radio" name="getway" id="pinikle" value="pinikle" checked>
                                        <label class="form-check-label pt-1" for="payment2">
                                            {{ __('front.pinikle') }}
                                        </label>
                                    </div>
                                </h2>
                                <div id="collapsePP" class="accordion-collapse collapse show" data-bs-parent="#accordionPayment" style="">
                                    <div class="accordion-body">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label>{{ __('front.first_name') }}</label>
                                                <input type="text" class="form-control" name="first_name" id="first_name" value="{{ auth()->user()->name }}">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>{{ __('front.last_name') }}</label>
                                                <input type="text" class="form-control" name="last_name" id="last_name">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>{{ __('front.email') }}</label>
                                                <input type="email" class="form-control" name="email" id="email" value="{{ auth()->user()->email }}">
                                            </div>
                                            <div class="col-md-12 text-start">
                                                <button type="button" class="btn btn-warning" id="get_pinikle_payments_list">{{ __('front.get_pinikle_payments_list') }}</button>
                                            </div>
                                        </div>

                                        <h3 >{{ __('front.pinikle_cards') }}</h3>
                                        <input type="hidden" name="subPaymentId" id="subPaymentId" value="">
                                        <div class="payments_list">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Right -->
                    <div class="col-lg-3">
                        <div class="card position-sticky top-0">
                            <div class="p-3 bg-light bg-opacity-10">
                                <h6 class="card-title mb-3">{{ __('front.order_summary') }}</h6>
                                <div class="d-flex justify-content-between mb-1 small">
                                    <span>{{ __('front.subtotal') }}</span> <span>${{ \Cart::getTotal() }}</span>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between mb-4 small">
                                    <span>{{ __('front.total') }}</span> <strong class="text-dark">${{ \Cart::getTotal() }}</strong>
                                </div>
                                <div class="form-check mb-1 small">
                                    <input class="form-check-input" type="checkbox" value="" id="tnc">
                                    <label class="form-check-label" for="tnc">
                                        {{ __('front.agree_terms') }}</a>
                                    </label>
                                </div>
                                <button class="btn btn-primary w-100 mt-2">{{ __('front.place_order') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(function() {
            $('#get_pinikle_payments_list').click(function() {
                var $this = $(this);
                var first_name = $('#first_name').val();
                var last_name  = $('#last_name').val();
                var subPaymentId = $(this).attr('data-subPaymentId');
                $('#subPaymentId').val(subPaymentId);
                var email = $('#email').val();

                $.ajax({
                    url: "{{ route('pinikle_payments_list') }}",
                    type:"POST",
                    data:{
                        first_name:first_name,
                        last_name:last_name,
                        email:email
                    },
                    beforeSend:function(){
                        $this.prop('disabled', true);
                    },
                    success:function(response){
                        if(response.success) {
                            $('.payments_list').html(response.payments_list)
                        } else {

                        }
                    },
                    error: function ( data ) {
                    },
                    complete: function ( ) {
                        $this.prop('disabled', false);
                    },
                });
            });
            $(document).on('click', '.pinikle_gateway',function() {
                var subPaymentId = $(this).attr('data-subPaymentId');
                $('#subPaymentId').val(subPaymentId);
            });
        })
    </script>
@endpush
