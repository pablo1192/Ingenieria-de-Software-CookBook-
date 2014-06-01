@extends('admin')

@section('contenido')
<h1>Gestión de Idiomas</h1>
<h2>Modificar «{{$idioma->nombre}}»</h2>
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
<form method="post" action="/admin/idiomas/{{$idioma->id}}/modificar">
	<input name="nombre" placeholder="Chino Mandarín" value="{{Input::old('nombre',$idioma->nombre)}}"/>
	<br/><br/>
	<input type="submit" value="Modificar" title="Agrega este idioma al sistema" />		
	<a href="/admin/idiomas/" style="text-decoration:none;">
		<input type="button" value="Cancelar" title="Cancela la operacion"/>
	</a>
</form>
@stop
