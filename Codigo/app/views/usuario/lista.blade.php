@extends('admin')

@section('menuActivo')
menuActivo='usuarios'
@stop

@section('contenido')
<a name="area"></a>
<h1>Gestión de usuarios:</h1>
<h2>Usuarios <span title="Usuarios en el Sistema">({{count($usuarios)}})</span>:</h2>
<table width="100%">
  <tr>
    <th>Nombre</th>
    <th>Apellido</th>
    <th>Email</th>
    <th>DNI</th>
    <th>Teléfono</th>
    <th>Provincia</th>
    <th>Localidad</th>
    <th>Dirección</th>
    <th>Bloqueado</th>
    <th>¿Activo?</th>
    <th>Operaciones</th>
  </tr>

{{--Datos del admin.--}}
{{--Función deshabilitada.
{{
'<tr align="center">
    <td>'.$usuarios[0]['nombre'].'</td>
    <td>--</td>
    <td>'.$usuarios[0]['email'].'</td>
    <td>--</td>
    <td>--</td>
    <td>--</td>
    <td><a href="/admin/usuarios/'. $usuarios[0]['id']. '/modificar" title="Modificar los datos del administrador">Modificar</a> </td>
  </tr>'
}}
--}}

{{--Corta el admin de la lista para no mostrar datos u operaciones irrelevantes.--}}
@foreach($usuarios ->slice(1) as $usuario)

  <tr align="center">
    <td>{{$usuario->nombre}}</td>
    <td>{{$usuario->apellido}}</td>
    <td>{{$usuario->email}}</td>
    <td>{{$usuario->dni}}</td>
    <td>{{$usuario->teléfono}}</td>
    <td>{{$usuario->provincia->nombre}}</td>
    <td>{{$usuario->localidad}}</td>
    <td>{{$usuario->dirección}}</td>
    <td>{{($usuario->bloqueado?'Sí':'No')}}</td>
    <td>{{($usuario->dadoDeBaja?'No':'Sí')}}</td>    
   {{-- <td><a href="/admin/usuarios/{{ $usuario->id }}/modificar" title="Modificar los datos del usuario">Modificar</a> --}}
    <td><a href="/admin/usuarios/{{ $usuario->id }}/bloquear" title="{{(($usuario->bloqueado)? 'Desbloquear': 'Bloquear')}} al usuario" onclick="return confirm('¿Seguro que desea {{(($usuario->bloqueado)? 'desbloquear': 'bloquear')}} al usuario?')">{{(($usuario->bloqueado)?'Desbloquear':'Bloquear')}}</a>
    </td>
  </tr>
  
@endforeach
</table>  

{{--
<h2>Función de testeo</h2>
<a href="/admin/usuarios/nuevo" title="Agregar un nuevo usuario">Agregar usuario</a> 
--}}

@stop