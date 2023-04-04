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
                    <i class="fas fa-arrow-circle-up fa-icon mr-2"></i>{{ __("Company car") }}
                </h1>
                <p class="font-1rem px-1">
                    {{ __("Fill out the form below and click the 'Send Request'' button when you're done to submit your car request") }}
                </p>
            </div> <!-- col-12 -->
        </div> <!-- row no-gutters -->
    </div>

    <div class="container px-3 px-sm-0">
        <form class="needs-validation" method="post" action="{{route('travel-submit')}}">
            @csrf
            <div class="row">
                <div class="col-lg-10">
                    <div class="rounded border shadow p-3 my-2">

                        <div class="row justify-content-between text-left">
                            <!-- Purpose -->
                            <div class="form-group col-sm-12 flex-column d-flex">
                                <label for="title" class="form-control-label px-1">{{ __("Purpose of the mission with the web address of the conference") }}
                                    <span class="text-danger"> *</span></label>
                                <textarea id="purpose" name="purpose" class="form-control"
                                          placeholder="{{ __("Purpose") }}" required></textarea>

                                <div class="invalid-feedback">
                                    {{__("Purpose is required")}}
                                </div>
                                <div><small class="text-danger">{{ $errors->first('purpose') }}</small></div>
                            </div>
                        </div>

                        <div class="row justify-content-between text-left">
                            <!-- Paper -->
                            <div class="form-group col-sm-6 flex-column d-flex">
                                <label class="form-select-label" for="paper">{{ __("Paper accepted") }}</label>
                                <div class="form-group form-group">
                                    <select class="form-select-input" id="paper" name="paper">
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>

                                </div>
                            </div>
                            <!-- Contribution -->
                            <div class="form-group col-sm-6 flex-column d-flex">
                                <label for="title_en" class="form-control-label px-1">{{ __("I have requested contribution from") }}<span
                                        class="text-danger"> *</span></label>
                                <input class="form-control" id="contribution" name="contribution" type="text"
                                       placeholder="{{ __("Contribution") }}"
                                       value="{{ old('contribution') ? old('contribution'): $contribution ?? '' }}">
                                <div class="invalid-feedback">
                                    {{__("Contribution is required")}}
                                </div>
                                <div><small class="text-danger">{{ $errors->first('contribution') }}</small></div>
                            </div>

                        </div>


                        <!-- Other reason -->
                        <div class="form-group col-sm-12 flex-column d-flex">
                            <label for="description" class="form-control-label px-1">{{ __("Other reason. Justify") }}</label>
                            <textarea id="reason" name="reason" class="form-control"
                                      placeholder="{{__("Other reason")}}"></textarea>
                        </div>

                        <div class="row justify-content-between text-left">
                            <!-- Departure -->
                            <div class="form-group col-sm-6 flex-column d-flex">
                                <label for="departure"
                                       class="form-control-label px-1">{{ __("Departure date") }}<span
                                        class="text-danger"> *</span></label>
                                <input id="departure" class="datepicker form-control" name="departure" type="text"
                                       autocomplete="off" data-provide="datepicker" data-date-autoclose="true"
                                       data-date-today-highlight="true" required>
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
                                <input id="return" class="datepicker form-control" name="return" type="text"
                                       autocomplete="off" data-provide="datepicker" data-date-autoclose="true"
                                       data-date-today-highlight="true" required>
                                <div class="invalid-feedback">
                                    {{__('Return date is required')}}
                                </div>
                                <div><small class="text-danger">{{ $errors->first('return') }}</small></div>
                            </div>
                        </div>
                        <!-- Total -->
                        <div class="row justify-content-between text-left">
                            <div class="form-group col-sm-3 flex-column d-flex">
                                <label for="project" class="form-control-label px-1">{{ __("Total") }}<span
                                        class="text-danger"> *</span></label>
                                <input class="form-control" id="total" name="total" type="text"
                                       placeholder="{{ __("Total in SEK") }}"
                                       value="{{ old('total') ? old('total'): $total ?? '' }}" required>
                                <div class="invalid-feedback">
                                    {{__("Total sum is required")}}
                                </div>
                                <div><small class="text-danger">{{ $errors->first('total') }}</small></div>
                            </div>
                        </div>
                        <!-- Project -->
                        <div class="row justify-content-between text-left">
                            <div class="form-group col-sm-6 flex-column d-flex">
                                <label for="project" class="form-control-label px-1">{{ __("Project") }}<span
                                        class="text-danger"> *</span></label>
                                <input class="form-control" id="project" name="project" type="text"
                                       placeholder="{{ __("Project with number") }}"
                                       value="{{ old('project') ? old('project'): $project ?? '' }}" required>
                                <div class="invalid-feedback">
                                    {{__("Project with number is required")}}
                                </div>
                                <div><small class="text-danger">{{ $errors->first('project') }}</small></div>
                            </div>
                        </div>

                        <!-- Status -->
                        {{--}}
                        <div class="row justify-content-evenly text-left">
                            <div class="form-group col-sm-3 flex-column d-flex">
                                <div class="row justify-content-between text-center">
                                    <label for="projectleader" class="form-control-label px-1">{{ __("The Project leader") }}</label>
                                    <span class="badge badge-primary font-100">Waiting for approval</span>
                                </div>
                            </div>
                            <div class="form-group col-sm-3 flex-column d-flex">
                                <div class="row justify-content-between text-center">
                                    <label for="unithead" class="form-control-label px-1">{{ __("Head of the unit") }}</label>
                                    <span class="badge badge-primary font-100">Waiting for approval</span>
                                </div>
                            </div>
                        </div>
                        {{--}}
                    </div> <!-- end -->
                </div>
            </div>
            <div class="d-flex row no-gutters col-sm-10 justify-content-end">
                <div class="col-md-2">
                    <div class="d-flex flex-row">
                        <button type="submit" id="submit" class="btn btn-lg btn-primary m-auto"><strong>{{ __("Send Request") }}</strong></button>
                    </div>
                </div>

            </div>

        </form>
    </div>
    <script>

        $("#paper").on('change', function() {
            if ($(this).is(':checked')) {
                $(this).attr('value', 'true');
            } else {
                $(this).attr('value', 'false');
            }
        });


        $(document).ready(function () {
            $('#paper').attr('value', 'false');
            $('.datepicker').datepicker({
                language: 'sv',
                weekStart: 1,
                todayHighlight: true
            });
        });
        $(".datepicker").datepicker({
            format: "dd/mm/yyyy",
            weekStart: 1,
            todayHighlight: true
        }).datepicker("setDate", new Date());
    </script>
@endsection
