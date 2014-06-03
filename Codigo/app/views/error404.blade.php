@extends('template')

@section('contenido')
<div class="cookbook" style="text-align:center;font-size:400%;margin:50px auto;">
	Error 404
</div>

<h2>El recurso no se encuentra disponible!</h2>
@if(Session::has('url'))
<p>Se ha producido un error al intentar acceder al recurso a través de la siguiente url:<p>
	<center> <strong>{{Session::get('url')}}</strong></center>
@else
<p>Se ha producido un error al intentar acceder a un recurso no disponible.<p>
@endif

@stop
