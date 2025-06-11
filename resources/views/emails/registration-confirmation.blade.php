@component('mail::message')
# Bem-vindo(a) {{ $user->name }}!

Obrigado por se cadastrar em nossa plataforma. Para começar a usar sua conta, por favor confirme seu endereço de e-mail clicando no botão abaixo.

@component('mail::button', ['url' => route('verification.verify', ['id' => $user->id, 'hash' => sha1($user->email)])])
Confirmar E-mail
@endcomponent

Se você não criou esta conta, nenhuma ação é necessária.

Atenciosamente,<br>
{{ config('app.name') }}
@endcomponent 