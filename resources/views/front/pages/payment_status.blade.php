@extends('front.layouts.master')

@section('content')
    <section class="py-5" style="min-height: 400px">
        <div class="container px-4 px-lg-5 mt-5">
            @include('flash::message')
        </div>
    </section>
@endsection
