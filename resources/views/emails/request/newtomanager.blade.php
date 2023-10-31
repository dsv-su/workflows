[DSV Intranet - Test]<br><br>
Dear Manager
<br><br>
A new <strong>{{$dashboard->type}}</strong> has been submitted that requires your immediate consideration.
Brief details in the request are as follows:
<br><br>
Requester: {{$user->name}}
<br><br>
Created: {{Carbon\Carbon::createFromTimestamp($dashboard->created)->toDateTimeString()}}
<br><br>
Your prompt attention to this matter is crucial to ensure that we can address this request effectively and meet our commitments to the requester.
Please review the request as soon as possible at:
<br><br>
https://workflow-test.dsv.su.se
<br><br>
Thank you for your prompt attention to this request.
