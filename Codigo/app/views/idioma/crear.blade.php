@extends('admin')

@section('contenido')
<h1>Gestión de Idiomas</h1>
<h2>Agregar un nuevo idioma</h2>
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
<form method="post" action="/admin/idiomas/crear">
	<input name="nombre" placeholder="Chino Mandarín" value=""/><span class="tooltip" title="El nombre debe contener sólo letras y de longitud mayor a 5.">[?]</span>
	<br/><br/>
	<input type="submit" value="Crear" title="Agrega este idioma al sistema" />
	<a href="/admin/idiomas/" style="text-decoration:none;">
		<input type="button" value="Cancelar" title="Cancela la operacion"/>
	</a>
</form>
@stop
