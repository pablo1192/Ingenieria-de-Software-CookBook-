@extends('admin')

@section('ayuda')
  <a href="/admin/ayuda#usuarios" onclick="pop_up(this);" title="Obtenga acceso a la ayuda del sistema"><img width="24" src="/template/images/ayuda.png" alt="Ayuda"/></a>
@overwrite

@section('menuActivo')
menuActivo='usuarios'
@stop

@section('contenido')
<a name="area"></a>
<h1>Gestión de usuarios:</h1>
<h2><a href="/admin/usuarios/" title="Regresar a la lista de usuarios">Usuarios totales <span title="Usuarios en el Sistema">({{count($usuarios)}})</span>:</a></h2>

@if (Session::has('FiltNombre'))
   <div class="mensaje mensaje-notificacion">
    {{Session::get('FiltNombre')}}  
   </div> 
@endif
@if(Session::has('FiltDNI'))
   <div class="mensaje mensaje-notificacion">
    {{Session::get('FiltDNI')}}    
   </div> 
@endif 
@if ((Session::has('FiltNombre'))||(Session::has('FiltDNI')))
   |<a href="/admin/usuarios" title="Mostrar todos los usuarios ">Quitar filtro</a>
@endif

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
	<div class="mensaje mensaje-notificacion">No se encontró ningún usuario con ese dato. <a href="/admin/usuarios/" title="Regresar a la lista de usuarios">Haga click aquí para regresar a la lista.</a></div>
@endif

<h2>Funciones de búsqueda</h2>
<form method="get" action="/admin/usuarios/">
  <select name="filtro" style="padding:2px;width:90px;display:inline;">
        <option value="nombre">Nombre</option>
        <option value="dni">DNI</option>
  </select>
  <input name="valor" size="25" value=""/>
  <input value="Buscar" type="submit"/> <span class="tooltip" title="El DNI a buscar debe ser exacto, no así el nombre o apellido.">[?]</span>
</form>
<a href="/admin/usuarios/vigentes" title="Ocultar eliminados y bloqueados">Ocultar los usuarios bloqueados y dados de baja.</a>


{{--
<h2>Función de testeo</h2>
<a href="/admin/usuarios/nuevo" title="Agregar un nuevo usuario">Agregar usuario</a> 
--}}

@stop