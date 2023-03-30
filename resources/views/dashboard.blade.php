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
        <div class="row justify-content-center">
            <a href="{{ route('travel-request-create') }}">Duty Travel Request</a>
        </div>
        
    </div>
@endsection
