@component('mail::message')
# Hola {{$user->name}}

Has cambiado tu correo eléctronico. Por favor verifícalo usando el siguiente botón:

@component('mail::button', ['url' => route('verify',$user->verification_token)])
Confirmar Cuenta
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
