@component('mail::message')
Hey!
<br>

{{ $mailData['name'] }} Followed You

Thanks,<br/>
{{ config('app.name') }}

@endcomponent
