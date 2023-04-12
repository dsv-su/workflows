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
                    {{ __("Duty Travel Request") }}
                </h1>
                <p class="font-1rem px-1">
                    {{ __("Review the request") }}
                </p>
            </div> <!-- col-12 -->
        </div> <!-- row no-gutters -->
    </div>

    <div class="container px-3 px-sm-0">
        <div class="row">
            <div class="col-lg-10">
                <div class="rounded border shadow p-3 my-2">
                    <div class="row justify-content-between text-left">
                        <!-- Purpose -->
                        <div class="form-group col-sm-12 flex-column d-flex">
                            <label for="title" class="form-control-label px-1">{{ __("Purpose of the mission with the web address of the conference") }}</label>
                            <textarea id="purpose" name="purpose" class="form-control" placeholder="{{ __("Purpose") }}" rows="4"
                                readonly>{{$request->purpose}}</textarea>
                        </div>
                    </div>
                    <!-- Project -->
                    <div class="row justify-content-between text-left">
                        <div class="form-group col-sm-6 flex-column d-flex" id="project-search-form">
                            <label for="project" class="form-control-label px-1">{{ __("Project") }}</label>
                            <div id="project-search-form" class="flex-column d-flex">
                                <input class="form-control mx-1 w-100" type="search"
                                       id="project-search" name="project" autocomplete="off"
                                       value="{{$request->project}}"
                                       readonly>
                            </div>
                        </div>
                        <div class="form-group col-sm-6 flex-column d-flex">
                            <label for="country" class="form-control-label px-1">{{ __("Country") }}</label>
                            <!-- country -->
                            <div class="form-control mx-1 w-100">{{$request->country}} (Allowance: {{$request->daily}} SEK per day)</div>
                        </div>
                    </div>
                    <br>
                    <!-- Project heads -->
                    <div class="row justify-content-between text-left">
                        <!-- Project leader -->
                        <div class="form-group col-sm-6 flex-column d-flex">
                            <label class="form-select-label px-3" for="paper">{{ __("Project leader") }}</label>
                            <div class="form-group form-group">
                                <input class="form-select-input form-control" id="project_leader" name="project_leader" value="{{$projectleader}}" readonly>
                            </div>
                        </div>
                        <!-- Unit head -->
                        <div class="form-group col-sm-6 flex-column d-flex">
                            <label for="title_en" class="form-control-label px-3">{{ __("Unit head") }}</label>
                            <div class="form-group form-group">
                                <input class="form-select-input form-control" id="unit_head" name="unit_head" value="{{$unithead}}" readonly>
                            </div>

                        </div>
                    </div>
                    <br>
                    <div class="row justify-content-between text-left">
                        <!-- Paper -->
                        <div class="form-group col-sm-6 flex-column d-flex">
                            <label class="form-select-label" for="paper">{{ __("Paper accepted") }}</label>
                            <div class="form-group form-group">
                                <input class="form-select-input form-control" id="paper" name="paper"
                                       value="@if($request->paper) Yes @else No @endif"
                                       @if(!$request->paper) style="background-color: #ff4c4c" @endif
                                       readonly>
                            </div>
                        </div>
                        <!-- Contribution -->
                        <div class="form-group col-sm-6 flex-column d-flex">
                            <label for="title_en" class="form-control-label px-1">{{ __("I have requested contribution from") }}</label>
                            <input class="form-control" id="contribution" name="contribution" type="text"
                                   placeholder="{{ __("Contribution") }}"
                                   value="{{ $request->contribution}}" readonly>
                        </div>
                    </div>
                    <!-- Other reason -->
                    <div class="form-group col-sm-12 flex-column d-flex">
                        <label for="description" class="form-control-label px-1">{{ __("Other reason. Justify") }}</label>
                        <textarea id="reason" name="reason" class="form-control"
                                  placeholder="{{__("Other reason")}}" readonly>{{$request->other}}</textarea>
                    </div>
                    <div class="row justify-content-between text-left">
                        <!-- Departure -->
                        <div class="form-group col-sm-6 flex-column d-flex">
                            <label for="departure"
                                   class="form-control-label px-1">{{ __("Departure date") }}<span
                                    class="text-danger"> *</span></label>
                            <input id="departure" class="form-control" name="departure" type="text"
                                   value="{{gmdate("Y-m-d", $request->departure)}}" readonly>
                            <div class="invalid-feedback">
                                {{__('Departure date is required')}}
                            </div>
                            <div><small class="text-danger">{{ $errors->first('departure') }}</small></div>
                        </div>
                        <!-- Return -->
                        <div class="form-group col-sm-6 flex-column d-flex">
                            <label for="return"
                                   class="form-control-label px-1">{{ __("Return date") }}<span
                                    class="text-danger"> *</span></label>
                            <input id="return" class="form-control" name="return" type="text"
                                   value="{{\Carbon\Carbon::createFromTimestamp($request->return)->format('Y-m-d')}}" readonly>
                            <div class="invalid-feedback">
                                {{__('Return date is required')}}
                            </div>
                            <div><small class="text-danger">{{ $errors->first('return') }}</small></div>
                        </div>
                    </div>
                    <!-- Costs -->
                    <div class="row justify-content-between text-left">
                        <div class="container-fluid">
                            <table class="table table-bordered">
                                <thead>
                                <tr class="d-flex">
                                    <th class="col-8">Prel. cost estimates</th>
                                    <th class="col">SEK</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr class="d-flex">
                                    <td class="col-8">Flight</td>
                                    <td class="col">
                                        <input class="form-control"
                                               name="flight"
                                               type="text"
                                               placeholder="{{ __("SEK") }}"
                                               value="{{ $request->flight }}">
                                    </td>
                                </tr>
                                <tr class="d-flex">
                                    <td class="col-8">Hotel</td>
                                    <td class="col">
                                        <input class="form-control" type="text"
                                               name="hotel"
                                               placeholder="{{ __("SEK") }}"
                                               value="{{ $request->hotel }}">
                                    </td>
                                </tr>
                                <tr class="d-flex">
                                    <td class="col-8">
                                        Daily subsistence allowances
                                    </td>
                                    <td class="col">
                                        <div class="form-control">
                                            {{ $request->daily * $request->days }}  ({{$request->daily}} * {{$request->days}} days)
                                        </div>

                                    </td>
                                </tr>
                                <tr class="d-flex">
                                    <td class="col-8">Conference fee</td>
                                    <td class="col">
                                        <input class="form-control" type="text"
                                               name="conference"
                                               placeholder="{{ __("SEK") }}"
                                               value="{{ $request->conference}}">
                                    </td>
                                </tr>
                                <tr class="d-flex">
                                    <td class="col-8">Other , such as taxi, bus, train</td>
                                    <td class="col">
                                        <input class="form-control" type="text"
                                               name="other_costs"
                                               value="{{ $request->other_costs }}">
                                    </td>
                                </tr>
                                <tr class="d-flex">
                                    <th class="col-8">Total <span class="text-danger"> *</span></th>
                                    <td class="col">
                                        <input class="form-control mx-auto perm" id="total" name="total" type="text"
                                               style="background-color: #F5F7FA;"
                                               value="{{ $request->total}}" readonly>

                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Project -->
                    <div class="row justify-content-between text-left">
                        <div class="form-group col-sm-6 flex-column d-flex"></div>
                        <div class="form-group col-sm-3 flex-column d-flex">
                            <div class="row justify-content-between text-center">
                                <div class="form-group col-sm-12 flex-column d-flex">
                                    <label for="status" class="form-control-label px-1">{{ __("Status") }}</label>
                                    @if($dsvrequest->pl_status == 1 && $dsvrequest->uh_status == 1 && $dsvrequest->admin_status == 1)
                                        <span class="badge bg-warning">Waiting for review</span>
                                    @elseif($dsvrequest->pl_status == 2 && $dsvrequest->uh_status == 1)
                                        <span class="badge bg-secondary">Waiting for review from unit head</span>
                                    @elseif($dsvrequest->pl_status == 1 && $dsvrequest->uh_status == 2)
                                        <span class="badge bg-secondary">Waiting for review from pl</span>
                                    @elseif($dsvrequest->pl_status == 2 && $dsvrequest->uh_status == 2 && $dsvrequest->admin_status == 1)
                                        <span class="badge bg-info">Waiting for review from finacialmanager</span>
                                    @elseif($dsvrequest->pl_status == 2 && $dsvrequest->uh_status == 2 && $dsvrequest->admin_status == 2)
                                        <span class="badge bg-success">Approved</span>
                                    @elseif($dsvrequest->pl_status == 3 or $dsvrequest->uh_status == 3 or $dsvrequest->admin_status == 3)
                                        <span class="badge bg-danger">Denied</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- end -->
            </div>
        </div>
        <div class="d-flex row no-gutters col-sm-10 justify-content-end">
            <div class="col-md-4">
                <div class="d-flex space-y-1 flex-row">
                    @hasanyrole('project-leader|unit-head|financial-manager')
                    @if((auth()->user()->id == $dsvrequest->projectleader && $dsvrequest->pl_status == 1)
                            or (auth()->user()->id == $dsvrequest->unithead && $dsvrequest->uh_status == 1)
                             or (auth()->user()->id == $dsvrequest->financialmanager && $dsvrequest->admin_status == 1))
                            <a href="{{route('travel-deny', $request->id)}}" type="button" role="button" class="btn btn-outline-danger m-auto"><strong>{{ __("Deny") }}</strong></a>
                            <a href="{{route('travel-approve', $request->id)}}" type="button" role="button" class="btn btn-outline-success m-auto"><strong>{{ __("Approve") }}</strong></a>
                        @endif
                    @endhasanyrole
                    <a href="{{route('dashboard')}}" type="button" role="button" class="btn btn-outline-primary m-auto"><strong>{{ __("Back") }}</strong></a>
                </div>
            </div>
        </div>
    </div>
@endsection
