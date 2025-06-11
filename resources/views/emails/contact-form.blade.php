@component('mail::message')
# Nova Mensagem de Contato

**Nome:** {{ $name }}  
**E-mail:** {{ $email }}

**Mensagem:**  
{{ $message }}

@component('mail::button', ['url' => config('app.url')])
Acessar o Sistema
@endcomponent

Obrigado,<br>
{{ config('app.name') }}
@endcomponent 