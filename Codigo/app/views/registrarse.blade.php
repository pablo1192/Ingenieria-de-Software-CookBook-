@extends('admin')

@section('contenido')

<h1>Agregar un usuario</h1>
<p>Complete los siguientes campos:</p>
   
@if($errors->has())
We encountered the following errors:
<ul>
    @foreach($errors->all() as $message)
    <li>{{ $message }}</li>
    @endforeach
</ul>
@endif
<form method="post" action="/registrarse">
    Nombre: <input name="nombre" value="{{Input::old('nombre')}}"/><br/>
    Apellido: <input name="apellido" value="{{Input::old('apellido')}}"/><br/>
    Email: <input name="email" value="{{Input::old('email')}}" placeholder="ejemplo@gmail.com"/><br/>
    DNI: <input name="dni" value="{{Input::old('dni')}}" placeholder="123456789"/><br/>
    Contraseña: <input type=password name="contraseña" value=""/><br/>
    Reescriba la contraseña: <input type=password name="contraseña_confirmation" value=""/><br/>
    <input type="submit" value="Guardar" title="Guardar usuario" />       
    <a href="/login" style="text-decoration:none;">
        <input type="button" value="Cancelar" title="Cancelar la operacion"/>
    </a>   
</form>

@stop