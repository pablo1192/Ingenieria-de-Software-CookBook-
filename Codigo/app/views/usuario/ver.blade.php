@extends('admin')

@section('ayuda')
    <a href="javascript: void(0)" onclick="popup('/admin/ayuda#usuarios')"><img width="24" src="/template/images/ayuda.png" alt="Ayuda"/></a>
@overwrite

@section('menuActivo')
menuActivo='usuarios'
@stop

@section('contenido')
<h2>Información de «{{$usuario->nombre}} {{$usuario->apellido}}»</h2>

<div style="width:650px">
	<div>
	<table width="40%" align="left">
		<tr>		
			<td>Nombre:</td>
			<td>{{$usuario->nombre}}</td>
		</tr>
		<tr>
			<td>Apellido:</td>
			<td>{{$usuario->apellido}}</td>
		</tr>
		<tr>
			<td>Email:</td>
			<td>{{HTML::mailto($usuario->email)}}</td>
		</tr>
		<tr>
			<td>DNI:</td>
			<td>{{$usuario->dni}}</td>
		</tr>
	</table>
	</div>
	<div>
	<table width="40%" align="center">
		<tr>		
			<td>Teléfono:</td>
			<td>{{$usuario->teléfono}}</td>
		</tr>
		<tr>
			<td>Provincia:</td>
			<td>{{$usuario->provincia->nombre}}</td>
		</tr>
		<tr>
			<td>Localidad:</td>
			<td>{{$usuario->localidad}}</td>
		</tr>
		<tr>
			<td>Dirección:</td>
			<td>{{$usuario->dirección}}</td>
		</tr>
	</table>
	</div>
</div>
</br>

<table width="40%">
	<tr>	
		<td>Fecha de alta: {{(date('d/m/Y',strtotime($usuario->created_at)))}}</td>
	</tr>
	<tr>
		<td><a href="/admin/usuarios/{{ $usuario->id }}/bloquear" title="{{(($usuario->bloqueado)? 'Desbloquear': 'Bloquear')}} al usuario" onclick="return confirm('¿Seguro que desea {{(($usuario->bloqueado)? 'desbloquear': 'bloquear')}} al usuario?')">Bloqueado: {{($usuario->bloqueado?'Sí':'No')}}</a></td>
	</tr>
	<tr>
		<td>Cuenta activa: {{($usuario->dadoDeBaja?'No':'Sí')}}</td>
	</tr>
</table>

<h2></h2>
<a href="/admin/usuarios" title="Retornar a usuarios totales">Volver a la lista de usuarios totales.</a> </br>
<a href="/admin/usuarios/vigentes" title="Retornar a usuarios vigentes">Volver a la lista de usuarios vigentes.</a>
@stop
