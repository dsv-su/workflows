@extends('layouts.dsv')
@section('content')
    <style>
        .datepicker {
            padding: 8px 15px;
            border-radius: 5px !important;
            margin: 5px 0px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            font-size: 14px !important;
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
                    {{ __("Fill out the form below and click the 'Send Request'' button when you're done to submit your travel request") }}
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
                        {{--}}
                        <div class="col-xl-3 col-sm-6 mb-5">
                            <div class="bg-white py-5 px-2">
                                <h5 class="mb-0">{{ Auth::user()->name }}</h5>
                            </div>
                        </div><!-- End -->
                        {{--}}
                        <div class="row justify-content-between text-left">
                            <!-- Purpose -->
                            <div class="form-group col-sm-12 flex-column d-flex">
                                <label for="title" class="form-control-label px-3">{{ __("Purpose of the mission with the web address of the conference") }}
                                    <span class="text-danger"> *</span></label>
                                <textarea id="purpose" name="purpose" class="form-control" rows="4"
                                          placeholder="{{ __("Purpose") }}" required></textarea>

                                <div class="invalid-feedback">
                                    {{__("Purpose is required")}}
                                </div>
                                <div><small class="text-danger">{{ $errors->first('purpose') }}</small></div>
                            </div>
                        </div>
                        <br>
                        <div class="row justify-content-between text-left">
                            <!-- Paper -->
                            <div class="form-group col-sm-6 flex-column d-flex">
                                <label class="form-select-label px-3" for="paper">{{ __("Paper accepted") }}</label>
                                <div class="form-group form-group">
                                    <select class="form-select-input form-control" id="paper" name="paper">
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>
                            <!-- Contribution -->
                            <div class="form-group col-sm-6 flex-column d-flex">
                                <label for="title_en" class="form-control-label px-3">{{ __("I have requested contribution from") }}<span
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
                        <br>
                        <!-- Other reason -->
                        <div class="form-group col-sm-12 flex-column d-flex">
                            <label for="description" class="form-control-label px-1">{{ __("Other reason. Justify") }}</label>
                            <textarea id="reason" name="reason" class="form-control"
                                      placeholder="{{__("Other reason")}}"></textarea>
                        </div>
                        <br>
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
                        <br>
                        <livewire:travel-total />
                        <br>
                        <!-- Project -->
                        <div class="row justify-content-between text-left">
                            <div class="form-group col-sm-6 flex-column d-flex" id="project-search-form">
                                <label for="project" class="form-control-label px-1">{{ __("Project") }}<span
                                        class="text-danger"> *</span></label>

                                {{--}}
                                <input class="form-control" id="project" name="project" type="text"
                                       placeholder="{{ __("Project with number") }}"
                                       value="{{ old('project') ? old('project'): $project ?? '' }}" required>
                                {{--}}


                                <div id="project-search-form" class="flex-column d-flex">
                                    <input class="form-control mx-1 w-100" type="search"
                                           id="project-search" name="query" autocomplete="off"
                                           aria-haspopup="true"
                                           placeholder="{{ __("Start typing to add a project number") }}"
                                           aria-labelledby="project-search">
                                </div>

                                <div class="invalid-feedback">
                                    {{__("Project with number is required")}}
                                </div>
                                <div><small class="text-danger">{{ $errors->first('project') }}</small></div>
                            </div>


                        </div>
                    </div> <!-- end -->
                </div>
            </div>
            <div class="d-flex row no-gutters col-sm-10 justify-content-end">
                <div class="col-md-2">
                    <div class="d-flex flex-row">
                        <button type="submit" id="submit" class="btn btn-primary m-auto"><strong>{{ __("Send Request") }}</strong></button>
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

        // Set the Options for "Bloodhound" suggestion engine
        var engine2 = new Bloodhound({
            remote: {
                url: '/findproject?query=%QUERY%',
                wildcard: '%QUERY%'
            },
            datumTokenizer: Bloodhound.tokenizers.whitespace('query'),
            queryTokenizer: Bloodhound.tokenizers.whitespace
        });

        $("#project-search").typeahead({
            classNames: {
                menu: 'search_autocomplete'
            },
            hint: false,
            autoselect: false,
            highlight: true,
            minLength: 2
        }, {
            source: engine2.ttAdapter(),
            limit: 20,
            // This will be appended to "tt-dataset-" to form the class name of the suggestion menu.
            name: 'autocomplete-items',
            display: function (item) {
                return item.project;
            },
            templates: {
                empty: [
                    ''
                ],
                header: [
                    ''
                ],
                suggestion: function (data) {
                    if ($('#addedProjects').find('input[value="' + data.id + '"]').length) {
                        return '<span></span>';
                    } else {
                        var name = data.project;
                        return '<a class="badge text-bg-light d-inline-block m-1 cursor-pointer" data-toggle="tooltip" data-title="' + name + '" data-id="' + data.id + '">' + '<span class="badge text-bg-primary">' + data.project + '</span>' + ' ' + data.description + data.projectleader + '</a>';
                    }
                }
            }
        }).on('keyup', function (e) {
            //$(".tt-suggestion:first-child").addClass('tt-cursor');
            let selected = $("#project-search").attr('aria-activedescendant');
            if (e.which === 13) {
                if (selected) {
                     //window.location.href = $("#" + selected).find('a').prop('href');
                }
            }
        });
    </script>
@endsection
