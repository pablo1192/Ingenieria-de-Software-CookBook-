@extends('admin')

@section('contenido')
<h1>Gestión de Autores</h1>
<h2>Agregar un nuevo autor</h2>
@if($errors->has('nombre'))
<div class="mensajeDeError">
	<p>Error en el nombre ingresado:</p>
	<ul>
		@foreach(($errors->get('nombre')) as $mensajeDeError)
		<li>{{$mensajeDeError}}</li>
		@endforeach
	</ul>
</div>
@endif
<form method="post" action="/admin/autores/crear">
	<input name="nombre" placeholder="Ingrese letras" value=""/> <span class="tooltip" title="El nombre debe tener una longitud mayor a 5 caracteres.">[?]</span>
	<br/><br/>
	<input type="submit" value="Crear" title="Agrega este autor al sistema" /> 
	<a href="/admin/autores/" style="text-decoration:none;">
		<input type="button" value="Cancelar" title="Cancela la operacion"/>
	</a>
</form>
@stop