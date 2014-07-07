@extends('admin')

@section('ayuda')
    <a href="javascript: void(0)" onclick="popup('/admin/ayuda#libros')"><img width="24" src="/template/images/ayuda.png" alt="Ayuda"/></a>
@overwrite

@section('menuActivo')
menuActivo='libros'
@stop

@section('contenido')
<h1>Gestión de Editoriales</h1>
<h2>Modificar «{{$editorial->nombre}}»</h2>
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
<form method="post" action="/admin/editoriales/{{$editorial->id}}/modificar">
	<input name="nombre" placeholder="Chino Mandarín" value="{{Input::old('nombre',$editorial->nombre)}}"/> <span class="tooltip" title="El nombre debe contener sólo letras y de longitud mayor a 5.">[?]</span>
	<br/><br/>
	<input type="submit" value="Modificar" title="Agrega esta editorial al sistema" />		
	<a href="/admin/editoriales/" style="text-decoration:none;">
		<input type="button" value="Cancelar" title="Cancela la operacion"/>
	</a>
</form>
@stop
