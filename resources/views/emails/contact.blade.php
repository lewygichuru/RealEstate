@component('mail::message')
# Hello, {{ $name }}
{{ $messageText }}

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
