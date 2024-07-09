<x-mail::message>
# Introduction

Hello Mr {{ $admin->name }}
<br>

<x-mail::button :url="route('admin.resetPassword', ['token' => $token, 'email' => $admin->email])">
Reset Password
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
