@component('mail::message')
# Introduction

Bienvenido :  {{$datos->email}}


Puslando sobre el boton "NUEVO TRABAJO ", podra subir a Rotuleon las fotos necesarias de :

{{$datos->obraD}}

@component('mail::button', ['url' => $datos->url])
NUEVO TRABAJO
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
