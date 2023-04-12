@extends('layouts.dsv')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                        {{Auth::user()->name}}

                            @hasanyrole('project-leader|unit-head')
                                <a href="/workflows" role="button" type="button" class="btn btn-outline-primary">Workflow scheme</a>
                                <a href="{{route('register')}}" role="button" type="button" class="btn btn-outline-primary">Create user</a>
                            @endhasanyrole
                            <a href="{{ route('logout') }}" role="button" type="button" class="btn btn-outline-primary">Logout</a>
                            <div class="float-end">
                                <span class="badge bg-primary">Users {{\App\Models\User::count()}}</span>
                            </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Your requests') }}</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Type</th>
                                <th>Name</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            @foreach($requests as $key => $request)
                                <tr>
                                    <td>{{$key +1 }} {{$request->type}}</td>
                                    <td> <a href="{{route('travel-request', $request->id)}}" class="link-primary"> {{ \App\Models\TravelRequest::Find($request->requestid)->purpose }}</a></td>
                                    <td>{{$request->created_at}}</td>
                                    <td>
                                        @if($request->pl_status == 1 && $request->uh_status == 1 && $request->admin_status == 1)
                                            <span class="badge bg-warning">Waiting for review</span>
                                        @elseif($request->pl_status == 2 && $request->uh_status == 1)
                                            <span class="badge bg-secondary">Waiting for review from unit head</span>
                                        @elseif($request->pl_status == 1 && $request->uh_status == 2)
                                            <span class="badge bg-secondary">Waiting for review from pl</span>
                                        @elseif($request->pl_status == 2 && $request->uh_status == 2 && $request->admin_status == 1)
                                            <span class="badge bg-info">Waiting for review from finacialmanager</span>
                                        @elseif($request->pl_status == 2 && $request->uh_status == 2 && $request->admin_status == 2)
                                            <span class="badge bg-success">Approved</span>
                                        @elseif($request->pl_status == 3 or $request->uh_status == 3 or $request->admin_status == 3)
                                            <span class="badge bg-danger">Denied</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <br>
        @hasanyrole('project-leader|unit-head|financial-manager')
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Awaiting your approval') }}</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Type</th>
                                <th>Name</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            @foreach($awaiting_requests as $key => $request)
                                <tr>
                                    @if((auth()->user()->id == $request->projectleader && $request->pl_status == 1) or (auth()->user()->id == $request->unithead && $request->uh_status == 1) or (auth()->user()->id == $request->financialmanager && $request->admin_status == 1))
                                    <td>{{$key +1 }}  {{$request->type}}</td>
                                    <td> <a href="{{route('travel-request', $request->id)}}" class="link-primary">{{ \App\Models\TravelRequest::Find($request->requestid)->purpose }}</a></td>
                                    <td>{{$request->created_at}}</td>
                                    <td>
                                        @if($request->pl_status == 1 && $request->uh_status == 1 && $request->admin_status == 1)
                                            <span class="badge bg-warning">Waiting for review</span>
                                        @elseif($request->pl_status == 2 && $request->uh_status == 1)
                                            <span class="badge bg-secondary">Waiting for review from unit head</span>
                                        @elseif($request->pl_status == 1 && $request->uh_status == 2)
                                            <span class="badge bg-secondary">Waiting for review from pl</span>
                                        @elseif($request->pl_status == 2 && $request->uh_status == 2 && $request->admin_status == 1)
                                            <span class="badge bg-info">Waiting for review from finacialmanager</span>
                                        @elseif($request->pl_status == 2 && $request->uh_status == 2 && $request->admin_status == 2)
                                            <span class="badge bg-success">Approved</span>
                                        @elseif($request->pl_status == 3 or $request->uh_status == 3 or $request->admin_status == 3)
                                            <span class="badge bg-danger">Denied</span>
                                        @endif
                                    </td>
                                    @endif
                                </tr>
                            @endforeach
                        </table>

                    </div>
                </div>
            </div>
        </div>
        @endhasanyrole
        <br>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column flex-lg-row">
                            <div class="row flex-fill">
                                <div class="col-sm-5">
                                    <h4 class="h5">Duty Travel Request</h4>
                                    <span class="badge bg-secondary"></span> <span class="badge bg-success"></span>
                                </div>
                                <div class="col-sm-4 py-2">
                                    <span class="badge bg-secondary"></span>
                                    <span class="badge bg-secondary"></span>
                                    <span class="badge bg-secondary"></span>
                                    <span class="badge bg-secondary"></span>
                                </div>
                                <div class="col-sm-3 text-lg-end">
                                    <a href="{{ route('travel-request-create') }}" class="btn btn-primary stretched-link">Request</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
