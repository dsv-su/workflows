[DSV Intranet]<br><br>
<strong>{{$dashboard->type}} Approved</strong>
<br><br>
Dear {{$user->name}},
<br><br>
This is a notification to inform you that your request has been successfully approved. Here are the details of the approved request:
<br><br>
<strong>RequestID:</strong> {{$dashboard->request_id}}
<br>
<strong>Request Type:</strong> {{$dashboard->type}}
<br>
<strong>Name:</strong> {{$dashboard->name}}
<br>
<strong>Created:</strong> {{Carbon\Carbon::createFromTimestamp($dashboard->created)->toDateTimeString()}}
<br>
<strong>Approval Date:</strong> {{$dashboard->updated_at}}
<br>
<br>
With your request approved, this request workflow is now closed. If you have any questions or require further assistance, please do not hesitate to reach out to helpdesk@dsv.su.se

