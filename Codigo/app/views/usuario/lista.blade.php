@extends('admin')

@section('menuActivo')
menuActivo='usuarios'
@stop

@section('contenido')
<a name="area"></a>
<h1>Gestión de usuarios:</h1>
<h2>Usuarios <span title="Usuarios en el Sistema">({{count($usuarios)}})</span>:</h2>
<table width="80%">
  <tr>
    <th>Nombre</th>
    <th>Email</th>
    <th>Bloqueado</th>
    <th>¿Activo?</th>
    <th>Operaciones</th>
  </tr>

@foreach($usuarios as $usuario)
  <tr align="center">
    <td>{{$usuario->nombre}} {{$usuario->apellido}}
    <td>{{HTML::mailto($usuario->email)}}</td>
    <td>{{($usuario->bloqueado?'Sí':'No')}}</td>
    <td>{{($usuario->dadoDeBaja?'No':'Sí')}}</td>    
    <td><a href="/admin/usuarios/{{ $usuario->id }}/ver" title="Visualizar los datos del usuario">Ver datos</a> |
    <a href="/admin/usuarios/{{ $usuario->id }}/bloquear" title="{{(($usuario->bloqueado)? 'Desbloquear': 'Bloquear')}} al usuario" onclick="return confirm('¿Seguro que desea {{(($usuario->bloqueado)? 'desbloquear': 'bloquear')}} al usuario?')">{{(($usuario->bloqueado)?'Desbloquear':'Bloquear')}}</a>
    </td>
  </tr>
@endforeach
</table>
@if (count($usuarios) == 0)
	<strong>No se encontró ningún usuario con ese dato.</strong>
@endif

<h2>Funciones de búsqueda</h2>
<form method="get" action="/admin/usuarios/">
<table>
	<tr>
    	<td align="center">Nombre:</td> <td><input type="text" name="nombre" value=""></td>
   		<td><input type="submit" value="Buscar"></td>
    </tr>
    <tr>
    	<td align="center">DNI:</td> <td><input type="text" name="dni" value=""></td>
    	<td><input type="submit" value="Buscar"></td>
    </tr>
</table>
</br>
</form>
<a href="/admin/usuarios/bloqueados" title="Ocultar eliminados">Ocultar los usuarios bloqueados y dados de baja.</a>


{{--
<h2>Función de testeo</h2>
<a href="/admin/usuarios/nuevo" title="Agregar un nuevo usuario">Agregar usuario</a> 
--}}

@stop