<x-mail::message>
# {{ __('mail.update_password.title') }}

{{ __('mail.update_password.hello') }} {{ $user->name }}, <br>

{{ __('mail.update_password.description') }}

{{ __('mail.update_password.thanks') }},<br>
{{ config('app.name') }}
</x-mail::message>
