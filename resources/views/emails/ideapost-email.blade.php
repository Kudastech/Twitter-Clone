@component('mail::message')

Welcome to Kudastech

Content: {{ $mailData['content'] }}<br/>
name: {{ $mailData['name'] }}

Thanks,<br/>
{{ config('app.name') }}

@endcomponent
