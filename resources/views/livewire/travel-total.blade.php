<div>
    <div class="row justify-content-between text-left">

        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col">Prel. cost estimates</th>
                <th scope="col">SEK</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Flight</td>
                <td>
                    <input wire:model="flight" class="form-control" type="text"
                           placeholder="{{ __("SEK") }}"
                           value="{{ old('flight') ? old('flight'): $flight ?? '' }}">
                </td>
            </tr>
            <tr>
                <td>Hotel</td>
                <td>
                    <input wire:model="hotel" class="form-control" type="text"
                           placeholder="{{ __("SEK") }}"
                           value="{{ old('hotel') ? old('flight'): $hotel ?? '' }}">
                </td>
            </tr>
            <tr>
                <td @if($days)
                    style="background-color: #F5F7FA;"
                    @endif
                >Daily subsistence allowances @if($days) x {{$days}} days @endif</td>
                <td>
                    <input wire:model="daily" class="form-control" type="text"
                           placeholder="{{ __("SEK") }}"
                           value="{{ old('daily') ? old('flight'): $daily ?? '' }}">
                </td>
            </tr>
            <tr>
                <td>Conference fee</td>
                <td>
                    <input wire:model="conference" class="form-control" type="text"
                           placeholder="{{ __("SEK") }}"
                           value="{{ old('conference') ? old('flight'): $conference ?? '' }}">
                </td>
            </tr>
            <tr>
                <td>Other , such as taxi, bus, train</td>
                <td>
                    <input wire:model="other" class="form-control" type="text"
                           placeholder="{{ __("SEK") }}"
                           value="{{ old('other') ? old('flight'): $other ?? '' }}">
                </td>
            </tr>
            <tr>
                <th>Total <span class="text-danger"> *</span></th>
                <td>
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
