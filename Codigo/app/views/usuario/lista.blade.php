@extends('usuario.listaGeneral')

@section('cuenta')
<h2>Usuarios <span title="Usuarios en el Sistema">({{count($usuarios) - 1}})</span>:</h2>
@stop

@section('listado')

{{--Corta el admin. Muestra el resto.--}}
@foreach($usuarios ->slice(1) as $usuario)
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

<h2>Funciones de búsqueda</h2>
<a href="/admin/usuarios/bloqueados" title="Ocultar eliminados">Ocultar los usuarios bloqueados y dados de baja.</a> 

{{--
<h2>Función de testeo</h2>
<a href="/admin/usuarios/nuevo" title="Agregar un nuevo usuario">Agregar usuario</a> 
--}}

@stop