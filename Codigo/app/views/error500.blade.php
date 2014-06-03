@extends('template')

@section('contenido')
<div class="cookbook" style="text-align:center;font-size:400%;margin:50px auto;">
	Error 500
</div>

<h2>Se ha producido un error interno!</h2>
@if(Session::has('mensajeDeError'))
	<p>Se ha producido un error interno en el servidor por el siguiente motivo: <strong>{{Session::get('mensajeDeError')}}</strong>.<p>
@else
	<p>Se ha producido un error interno en el servidor por motivos desconocidos.<p>
@endif


	

@stop
