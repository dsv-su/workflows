<div>
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
                            <input wire:model="flight" class="form-control"
                                   name="flight"
                                   type="text"
                                   placeholder="{{ __("SEK") }}"
                                   value="{{ old('flight') ? old('flight'): $flight ?? '' }}">
                        </td>
                    </tr>
                    <tr class="d-flex">
                        <td class="col-8">Hotel</td>
                        <td class="col">
                            <input wire:model="hotel" class="form-control" type="text"
                                   name="hotel"
                                   placeholder="{{ __("SEK") }}"
                                   value="{{ old('hotel') ? old('flight'): $hotel ?? '' }}">
                        </td>
                    </tr>
                    <tr class="d-flex">
                        <td class="col-8" @if($days) style="background-color: #F5F7FA;" @endif>
                            Daily subsistence allowances @if($days) x {{$days}} days @endif
                        </td>
                        <td class="col">
                            <input wire:model="daily" class="form-control" type="text"
                                   placeholder="@if(!$daily){{ __("Please select a country destination") }}@endif"
                                   name="daily"
                                   value="{{ old('daily') ? old('flight'): $daily ?? '' }}"
                                   @if($daily)
                                   style="background-color: #F5F7FA;"
                                   @endif
                                   readonly>
                        </td>
                    </tr>
                    <tr class="d-flex">
                        <td class="col-8">Conference fee</td>
                        <td class="col">
                            <input wire:model="conference" class="form-control" type="text"
                                   name="conference"
                                   placeholder="{{ __("SEK") }}"
                                   value="{{ old('conference') ? old('flight'): $conference ?? '' }}">
                        </td>
                    </tr>
                    <tr class="d-flex">
                        <td class="col-8">Other , such as taxi, bus, train</td>
                        <td class="col">
                            <input wire:model="other" class="form-control" type="text"
                                   name="other_costs"
                                   placeholder="{{ __("SEK") }}"
                                   value="{{ old('other') ? old('flight'): $other ?? '' }}">
                        </td>
                    </tr>
                    <tr class="d-flex">
                        <th class="col-8">Total <span class="text-danger"> *</span></th>
                        <td class="col">
                            <input wire:model="total" class="form-control mx-auto perm" id="total" name="total" type="text"
                                   style="background-color: #F5F7FA;"
                                   placeholder="{{ __("Total in SEK") }}"
                                   value="{{ old('total') ? old('total'): $total ?? '' }}" readonly>

                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <input wire:model="countryname" name="countryname" hidden>
    <input wire:model="days" name="days" hidden>
</div>
