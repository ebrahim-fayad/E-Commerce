<x-mail::message>
# Introduction
Hello : {{ $seller->name }}
This Email For Rest Yuor Password.

<x-mail::button :url=" route('seller.resetPassword', ['email'=>$seller->email,'token'=>$token]) ">
Rest Password
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
