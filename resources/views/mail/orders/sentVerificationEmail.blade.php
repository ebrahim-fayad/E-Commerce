<x-mail::message>
# Introduction
Helloe sir / miss : {{ $seller->name }}

This Email To Verified Your Email.

<x-mail::button :url="route('seller.verify', ['token' => $token, 'email' => $seller->email])">
    Verify Email
</x-mail::button>
Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
