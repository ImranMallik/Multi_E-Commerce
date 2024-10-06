@extends('frontend.layouts.master')
@section('title')
    {{ $settings->site_name }} || Payment Success
@endsection
@section('content')
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>Payment Successfully</h4>
                        <ul>
                            <li><a href="{{ route('home') }}">home</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="wsus__cart_view">
        <div class="container">
            <div class="wsus__pay_info_area">
                <h1>Payment Success</h1>
            </div>
        </div>
    </section>
@endsection
