@extends('layouts.dsv')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                        You are Logged In
                            <a href="/workflows" role="button" type="button" class="btn btn-outline-primary">Workflow scheme</a>
                            <a href="{{ route('register') }}" role="button" type="button" class="btn btn-outline-primary">Create a new user</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>


    <br>
    <a href="{{ route('travel-request') }}">Duty Travel Request</a>
@endsection
