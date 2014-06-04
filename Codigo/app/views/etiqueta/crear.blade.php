@extends('admin')

@section('menuActivo')
menuActivo='libros'
@stop

@section('contenido')

<h1>Agregar una etiqueta</h1>
<p>Complete el siguiente campo:</p>
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
<form action="/admin/etiquetas/crear" method="post">
	Nombre: <input name="nombre" value="" placeholder="Ingrese sólo letras"/><span class="tooltip" title="El nombre debe contener sólo letras.">[?]</span><br/> 
	<br/><br/>
	<input type="submit" value="Crear" title="Agrega esta etiqueta a Cookbook"/>

	<input type="reset" value="Limpiar" title="Borra el dato ingresado"/>
	
	
	<a href="/admin/etiquetas/" style="text-decoration:none;"><input type="button" value="Cancelar" title="Cancela la operacion"/></a>
	
	
</form>

@stop
