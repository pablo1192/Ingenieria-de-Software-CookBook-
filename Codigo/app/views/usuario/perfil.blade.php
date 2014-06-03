@extends('admin')

@section('contenido')

<h1>Perfil</h1>
<h2>«{{Auth::user()->nombre . ' ' . Auth::user()->apellido}}»</h2>

@if($errors->has())
We encountered the following errors:
<ul>
    @foreach($errors->all() as $message)

    <li>{{ $message }}</li>

    @endforeach
</ul>
@endif

<form method="post" action="/perfil">
	Nombre: <input name="nombre" value="{{Input::old('nombre',Auth::user()->nombre)}}"/><br/>
	Apellido: <input name="apellido" value="{{Input::old('apellido',Auth::user()->apellido)}}"/><br/>
	Email: <input name="email" value="{{Input::old('email',Auth::user()->email)}}"/><br/>
	DNI: <input name="dni" value="{{Input::old('dni',Auth::user()->dni)}}"/><br/>
	Contraseña: <input type=password name="contraseña" value=""/><br/>
	<br/>
	<input type="submit" value="Modificar" title="Modificar los datos" />		
	<a href="/admin/usuarios/" style="text-decoration:none;">
		<input type="button" value="Cancelar" title="Cancelar la operacion"/>
	</a>
</form>
<br/>
  ----------------<br/>
| <a href="/eliminar" title="Darse de baja" onclick="return confirm('¿Realmente desea darse de baja en el sistema?')">Darse de baja</a> | <strong>Advertencia: Esta operación no puede deshacerse.</strong><br/>  ----------------
@stop