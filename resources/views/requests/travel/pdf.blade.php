<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TravelRequest</title>
    <link rel="stylesheet" href="{{ asset('./tr/pdf.css') }}" type="text/css">
</head>
<body>
<header>
  <div class="headerSection">
    <div class="logoAndName">
        <img src="{{ asset('./images/su_cp.png') }}" alt="Stockholms University" width="100" />
    </div>
  </div>
  <p style="margin-top:.8cm">{{__("Department of Computer and Systems Sciences")}}</p>
</header>

<req>
    <table>
        <thead>
        <tr>
            <th>{{__("Name")}}</th>
            <th>{{__("Request Created")}}</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>
                {{$user->name}}
            </td>
            <td>
                {{\Carbon\Carbon::createFromTimestamp($tr->created)->toDateString()}}
            </td>
        </tr>
    </table>
    <br>
    <table>
        <thead>
        <tr>
            <th>{{__("Purpose")}}</th>
            <th>{{__("Paper accepted")}}</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>
                {{$tr->purpose}}
            </td>
            <td>
                @if($tr->paper == 0 or $tr->paper == null)
                {{__("No")}}
                @else
                {{__("Yes")}}
                @endif
            </td>
        </tr>
    </table>
    <br><br>
    <table>
        <thead>
        <tr>
            <th>{{__("Country")}}</th>
            <th>{{__("Daily subsistence allowances")}}</th>
            <th>{{__("Departure date")}}</th>
            <th>{{__("Return date")}}</th>
            <th>{{__("Total days")}}</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>
                {{$tr->country}}
            </td>
            <td>
                {{$tr->daily}} SEK
            </td>
            <td>
                {{\Carbon\Carbon::createFromTimestamp($tr->departure)->toDateString()}}
            </td>
            <td>
                {{\Carbon\Carbon::createFromTimestamp($tr->return)->toDateString()}}
            </td>
            <td>
                {{$tr->days}}
            </td>
        </tr>
    </table>
    <br>
    <table>
        <thead>
        <tr>
            <th>{{__("ProjectID")}}</th>
            <th>{{__("Project leader")}}</th>
            <th>{{__("Unit head")}}</th>
            <th>{{__("Approved date")}}</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>
                {{$tr->project}}
            </td>
            <td>
                {{$manager->name}}
            </td>
            <td>
                {{$head->name}}
            </td>
            <td>
                {{\Carbon\Carbon::parse($tr->updated_at)->format('Y-m-d')}}
            </td>
        </tr>
    </table>
    <br>
    <b>{{__("Comments from")}}:</b>
    <br>
    <table>
        <thead>
        <tr>
            <th>{{__("Project leader")}}</th>
            <th>{{__("Unit Head")}}</th>
            <th>{{__("Financial Officer")}}</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>
                @if($tr->manager_comment_id ?? false)
                {{\App\Models\ManagerComment::find($tr->manager_comment_id)->comment}}
                @else
                    {{__("No comments")}}
                @endif
            </td>
            <td>
                @if($tr->head_comment_id ?? false)
                    {{\App\Models\ManagerComment::find($tr->head_comment_id)->comment}}
                @else
                    {{__("No comments")}}
                @endif
            </td>
            <td>
                @if($tr->fo_comment_id ?? false)
                    {{\App\Models\ManagerComment::find($tr->fo_comment_id)->comment}}
                @else
                    {{__("No comments")}}
                @endif
            </td>
        </tr>
    </table>
</req>

<br><br>
<main>
  <table>
    <thead>
      <tr>
        <th>{{__("Expenses")}}</th>
        <th>SEK</th>
        <th>{{__("Amount")}}</th>
        <th>{{__("Total")}}</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>
          <b>{{__("Flight")}}</b>
        </td>
        <td>
            @if($tr->flight == null or $tr->flight == 0)
                0
            @else
                {{$tr->flight}}
            @endif
        </td>
        <td>
          1
        </td>
        <td>
            @if($tr->flight == null or $tr->flight == 0)
                0
            @else
                {{$tr->flight}}
            @endif
        </td>
      </tr>
      <tr>
        <td>
          <b>{{__("Hotel")}}</b>
        </td>
        <td>
            @if($tr->hotel == null or $tr->hotel == 0)
                0
            @else
                {{$tr->hotel}}
            @endif
        </td>
        <td>
            {{$tr->days}} {{__("days")}}
        </td>
        <td>
            @if($tr->hotel == null or $tr->hotel == 0)
                0
            @else
                {{$tr->hotel}}
            @endif
        </td>
      </tr>
      <tr>
        <td>
          <b>{{__("Other costs")}}</b>
        </td>
        <td>
            @if($tr->other_costs == null or $tr->other_costs == 0)
                0
            @else
                {{$tr->other_costs}}
            @endif
        </td>
        <td>
            @if($tr->other_costs == null or $tr->other_costs == 0)
                0
            @else
                1
            @endif
        </td>
        <td>
            @if($tr->other_costs == null or $tr->other_costs == 0)
                0
            @else
                {{$tr->other_costs}}
            @endif
        </td>
      </tr>
    </tbody>
  </table>
  <br><br>
  <table >
    <tr>
      <th>
        {{__("Subtotal")}}
      </th>
      <td>
          {{$tr->total}}
      </td>
    </tr>
    <tr>
      <th>
        {{__("Moms")}} 25%
      </th>
      <td>
          {{$tr->total * 0.25}}
      </td>
    </tr>
    <tr>
      <th>
        {{__("Total")}}
      </th>
      <td>
          <b>{{$tr->total}} SEK</b>
      </td>
    </tr>
  </table>
</main>

</body>
</html>
