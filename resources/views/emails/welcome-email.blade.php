@component('mail::message')

Welcome to Kudastech

Name: {{ $mailData['name'] }}<br/>
<br>
Email: {{ $mailData['email'] }} <br>
<br>
Ip Address: {{ $mailData['ip_address'] }}

Thanks,<br/>
{{ config('app.name') }}

@endcomponent
