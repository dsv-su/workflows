@extends('layouts.dsv')
@section('content')
    <style>
        .datepicker {
            padding: 8px 15px;
            border-radius: 5px !important;
            margin: 5px 0px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            font-size: 16px !important;
            font-weight: 300
        }
    </style>
    <!-- Header message section -->
    <div class="container banner-inner">
        <div class="row no-gutters w-100">
            <div class="col-12">
                <span class="su-theme-anchor"></span>
                <h1 class="su-theme-header mb-4">
                    <i class="fas fa-arrow-circle-up fa-icon mr-2"></i>{{ __("Duty Travel Request") }}
                </h1>
                <p class="font-1rem px-1">
                    {{ __("Fill out the form below and click the 'Request'' button when you're done to submit your travel request") }}
                </p>
            </div> <!-- col-12 -->
        </div> <!-- row no-gutters -->
    </div>
@endsection
