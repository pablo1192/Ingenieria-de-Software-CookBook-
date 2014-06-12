@extends('usuario.listaGeneral')

@section('cuenta')
<h2>Usuarios <span title="Usuarios en el Sistema">(Cuenta a implementar)</span>:</h2>
@stop

@section('listado')

{{--Corta el admin. Oculta los bloqueados y dados de baja.--}}
@foreach($usuarios ->slice(1) as $usuario)
@if(($usuario->dadoDeBaja == 0) && ($usuario->bloqueado == 0))
  <tr align="center">
    <td>{{$usuario->nombre}} {{$usuario->apellido}}
    <td>{{HTML::mailto($usuario->email)}}</td>
    <td>{{($usuario->bloqueado?'Sí':'No')}}</td>
    <td>{{($usuario->dadoDeBaja?'No':'Sí')}}</td>    
    <td><a href="/admin/usuarios/{{ $usuario->id }}/ver" title="Visualizar los datos del usuario">Ver datos</a> |
    <a href="/admin/usuarios/{{ $usuario->id }}/bloquear" title="{{(($usuario->bloqueado)? 'Desbloquear': 'Bloquear')}} al usuario" onclick="return confirm('¿Seguro que desea {{(($usuario->bloqueado)? 'desbloquear': 'bloquear')}} al usuario?')">{{(($usuario->bloqueado)?'Desbloquear':'Bloquear')}}</a>
    </td>
  </tr>
@endif
@endforeach
</table>  
<h2></h2>

<h2>Funciones de búsqueda</h2>
<a href="/admin/usuarios" title="Ver todos">Mostrar todos los usuarios.</a> 

@stop