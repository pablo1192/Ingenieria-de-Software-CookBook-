@extends('admin')

@section('contenido')

<h1>Gestión de Usuarios</h1>
<h2>Modificar «{{$usuario->nombre . ' ' . $usuario->apellido}}»</h2>

@if($errors->has())
We encountered the following errors:
<ul>
    @foreach($errors->all() as $message)

    <li>{{ $message }}</li>

    @endforeach
</ul>
@endif

<form method="post" action="/admin/usuarios/{{$usuario->id}}/modificar">
	Nombre: <input name="nombre" value="{{Input::old('nombre',$usuario->nombre)}}"/><br/>
	Apellido: <input name="apellido" value="{{Input::old('apellido',$usuario->apellido)}}"/><br/>
	Email: <input name="email" value="{{Input::old('email',$usuario->email)}}"/><br/>
	DNI: <input name="dni" value="{{Input::old('dni',$usuario->dni)}}"/><br/>
	Contraseña: <input type=password name="contraseña" value=""/><br/>
	<br/><br/>
	<input type="submit" value="Modificar" title="Modificar los datos" />		
	<a href="/admin/usuarios/" style="text-decoration:none;">
		<input type="button" value="Cancelar" title="Cancelar la operacion"/>
	</a>
</form>
@stop
