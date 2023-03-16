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
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="card">
        <div class="card-header">
            42 Workflows
        </div>
        <div class="card-body">
            <p class="card-text">42 Workflows is an free open source package to help you to automate your workflows. <a href="https://workflows.42coders.com/" target="_blank">Manual</a></p>
            <a href="/workflows" role="button" type="button" class="btn btn-outline-primary">Go to test 42 Workflows</a>
            <a href="{{ route('register') }}" role="button" type="button" class="btn btn-outline-primary">Create a new user</a>
        </div>
    </div>
@endsection
