@extends('admin')

@section('contenido')
<h1>Gestión de Etiquetas</h1>
<h2>Modificar «{{$etiqueta->nombre}}»</h2>
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
<form method="post" action="/admin/etiquetas/{{$etiqueta->id}}/modificar">
	<input name="nombre" placeholder="salsas" value="{{Input::old('nombre',$etiqueta->nombre)}}"/> <span class="tooltip" title="El nombre debe contener sólo letras.">[?]</span>
	<br/><br/>
	<input type="submit" value="Modificar" title="Modifica la etiqueta en el sistema" />		
	<a href="/admin/etiquetas/" style="text-decoration:none;">
		<input type="button" value="Cancelar" title="Cancela la operacion"/>
	</a>
</form>
@stop
