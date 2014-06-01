@extends('admin')

@section('contenido')

<h1>Agregar una etiqueta</h1>
<p>Complete el siguiente campo:</p>
<form action="/admin/etiquetas/crear" method="post">
	Nombre: <input name="nombre" value="" placeholder="No ingrese carácteres númericos, ni especiales"/><br/>
	<br/><br/>
	<input type="submit" value="Crear" title="Agrega esta etiqueta a Cookbook"/>

	<input type="reset" value="Limpiar" title="Borra el dato ingresado"/>
	
	
	<a href="/admin/etiquetas/" style="text-decoration:none;"><input type="button" value="Cancelar" title="Cancela la operacion"/></a>
	
	
</form>

@stop
