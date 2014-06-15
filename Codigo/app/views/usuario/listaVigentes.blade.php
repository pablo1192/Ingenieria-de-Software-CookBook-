@extends('admin')

@section('menuActivo')
menuActivo='usuarios'
@stop

@section('contenido')
<a name="area"></a>
<h1>Gestión de usuarios:</h1>
<h2><a href="/admin/usuarios/vigentes" title="Regresar a la lista de usuarios">Usuarios vigentes <span title="Usuarios en el Sistema">({{count($usuarios)}})</span>:</a></h2>
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
	<div class="mensaje mensaje-error">No se encontró ningún usuario con ese dato. <a href="/admin/usuarios/vigentes" title="Regresar a la lista de usuarios">Haga click aquí para regresar a la lista.</a></div>
@endif

<h2>Funciones de búsqueda</h2>
<table>
<form method="get" action="/admin/usuarios/vigentes">
	<tr>
    	<td align="center">Nombre:</td> <td><input type="text" name="nombre" value=""></td>
   		<td><input type="submit" value="Buscar"></td>
    </tr>
</form>
<form method="get" action="/admin/usuarios/vigentes">
    <tr>
    	<td align="center">DNI:</td> <td><input type="text" name="dni" value=""></td>
    	<td><input type="submit" value="Buscar"></td>
    </tr>
</form>
</table>
</br>
<a href="/admin/usuarios/" title="Mostrar eliminados y bloqueados">Mostrar todos los usuarios.</a>


{{--
<h2>Función de testeo</h2>
<a href="/admin/usuarios/nuevo" title="Agregar un nuevo usuario">Agregar usuario</a> 
--}}

@stop