@component('mail::message')


Welcome <label style='text-transform: capitalize;'>{{ $data['username'] }}</label>,

Click on below button to varify Email Address
@component('mail::button', ['url' => $data['url'] ])
Varify Email
@endcomponent

Thanks&Regards,<br>
{{ config('app.name') }}
@endcomponent
