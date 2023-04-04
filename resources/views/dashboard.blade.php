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
                        {{Auth::user()->name}}
                            <br><br>

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
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Your requests') }}</div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                            </thead>

                            @foreach($travelrequests as $key => $travel)
                                <tr>
                                    <td><a href="{{route('travel-request', $travel->id)}}" class="link-primary">{{$key +1 }} {{$travel->purpose}}</a></td>
                                    <td>{{$travel->created_at}}</td>

                                    <td>
                                        @if($travel->status == 'requested')
                                            <span class="badge bg-primary">Awaiting approval</span>
                                        @elseif($travel->status == 'Awaiting')
                                            <span class="badge bg-warning">Awaiting approval</span>
                                        @elseif($travel->status == 'Approved')
                                            <span class="badge bg-success">Approved</span>
                                        @elseif($travel->status == 'Denied')
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
    </div>

    <br>

    <div class="container">
        <div class="text-center mb-5">
            <h3>Requests</h3>
            <p class="lead"></p>
        </div>
        <div class="card mb-3">
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
        <!-- Car -->
        {{--}}
        <div class="card mb-3">
            <div class="card-body">
                <div class="d-flex flex-column flex-lg-row">
                    <div class="row flex-fill">
                        <div class="col-sm-5">
                            <h4 class="h5">Company car</h4>
                            <span class="badge bg-secondary"></span> <span class="badge bg-success"></span>
                        </div>
                        <div class="col-sm-4 py-2">
                            <span class="badge bg-secondary"></span>
                            <span class="badge bg-secondary"></span>
                            <span class="badge bg-secondary"></span>
                            <span class="badge bg-secondary"></span>
                        </div>
                        <div class="col-sm-3 text-lg-end">
                            <a href="{{ route('car-request-create') }}" class="btn btn-primary stretched-link">Request</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--}}
    </div>


@endsection
