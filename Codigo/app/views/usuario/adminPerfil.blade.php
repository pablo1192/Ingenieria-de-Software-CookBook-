@extends('admin')

@section('ayuda')
    <a href="javascript: void(0)" onclick="popup('/ayuda#cuenta')"><img width="24" src="/template/images/ayuda.png" alt="Ayuda"/></a>
@overwrite

@section('contenido')

<h1>Perfil</h1>
<h2>«Administrador»</h2>

@if($errors->has())
<ul>
    @foreach($errors->all() as $message)

    <li>{{ $message }}</li>

    @endforeach
</ul>
@endif

<form method="post" action="/admin/perfil">
	Contraseña: <input type=password name="contraseña" value=""/><span class="tooltip" title="La contraseña debe tener una longitud mayor a 5 caracteres.">[?]</span><br/>
	Reescriba la contraseña: <input type=password name="contraseña_confirmation" value=""/><span class="tooltip" title="Repita la contraseña para confirmar su modificación.">[?]</span> <br/>
	<br/>
	<input type="submit" value="Modificar" title="Modificar los datos" />		
	<a href="/admin/usuarios/" style="text-decoration:none;">
		<input type="button" value="Cancelar" title="Cancelar la operacion"/>
	</a>
</form>
@stop