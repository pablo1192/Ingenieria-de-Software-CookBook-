@extends('admin')

@section('contenido')

<h1>Perfil</h1>
<h2>«{{Auth::user()->nombre . ' ' . Auth::user()->apellido}}»</h2>

@if($errors->has())
<ul>
    @foreach($errors->all() as $message)

    <li>{{ $message }}</li>

    @endforeach
</ul>
@endif

<form method="post" action="/perfil">
	Nombre: <input name="nombre" value="{{Input::old('nombre',Auth::user()->nombre)}}"/><span class="tooltip" title="El nombre debe tener una longitud mayor a 2 caracteres.">[?]</span><br/>
	Apellido: <input name="apellido" value="{{Input::old('apellido',Auth::user()->apellido)}}"/><span class="tooltip" title="El apellido debe tener una longitud mayor a 2 caracteres.">[?]</span><br/>
	Email: <input name="email" value="{{Input::old('email',Auth::user()->email)}}"/><span class="tooltip" title="El email debe ser una dirección de correo válida.">[?]</span><br/>
	DNI: <input name="dni" value="{{Input::old('dni',Auth::user()->dni)}}"/><span class="tooltip" title="El DNI debe ser un número de 7 u 8 dígitos.">[?]</span><br/>
	Contraseña: <input type=password name="contraseña" value=""/><span class="tooltip" title="La contraseña debe tener una longitud mayor a 5 caracteres.">[?]</span><br/>
	Reescriba la contraseña: <input type=password name="contraseña_confirmation" value=""/><span class="tooltip" title="Repita la contraseña para confirmar su registro.">[?]</span> <br/>
	<br/>
	<input type="submit" value="Modificar" title="Modificar los datos" />		
	<a href="/admin/usuarios/" style="text-decoration:none;">
		<input type="button" value="Cancelar" title="Cancelar la operacion"/>
	</a>
</form>
<br/>
 <br/>
<a href="/eliminar" class="button button-rojo button-mediano" title="Darse de baja" onclick="return confirm('¿Realmente desea darse de baja en el sistema?')">Darse de baja</a> | <strong>Advertencia: Esta operación no puede deshacerse.</strong><br/>
@stop