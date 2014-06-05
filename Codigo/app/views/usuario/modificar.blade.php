@extends('admin')

@section('menuActivo')
menuActivo='usuarios'
@stop

@section('contenido')

@if($usuario->id != 1)
<h1>Gestión de usuarios:</h1>
<h2>Modificar «{{$usuario->nombre . ' ' . $usuario->apellido}}»</h2>

@if($errors->has())
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
	Teléfono: <input name="teléfono" value="{{Input::old('teléfono',$usuario->teléfono)}}"/><br/>
	Provincia:<select name="provincia">              
                @foreach($provincias as $provincia)
                    {{'<option value="'. $provincia->id .'">'. $provincia->nombre .'</option>'}}
                @endforeach</select> 
    Localidad: <input name="localidad" value="{{Input::old('localidad', $usuario->localidad)}}"/><br/>
    Domicilio: <input name="dirección" value="{{Input::old('dirección', $usuario->dirección)}}"/><br/>
	Contraseña: <input type=password name="contraseña" value=""/><br/>
	Reescriba la contraseña: <input type=password name="contraseña_confirmation" value=""/><br/>
	<br/><br/>
	<input type="submit" value="Modificar" title="Modificar los datos" />		
	<a href="/admin/usuarios/" style="text-decoration:none;">
		<input type="button" value="Cancelar" title="Cancelar la operacion"/>
	</a>
</form>
@else
<br/>
<center><strong>Operación prohibida. Regrese usando los enlaces del panel de administración.</strong></center>
@endif
@stop
