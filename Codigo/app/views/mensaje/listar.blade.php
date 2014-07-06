@extends('admin')

@section('contenido')
<h1>Gestión de Mensajes</h1>

<h2>Mensajes (<span title="Cantidad total de mensajes">{{count($mensajes)}}</span>):</h2>
@if(count($mensajes))
	<table width="900px">
		<tr align="left">
			<th>Usuario</th>
			<th>Asunto</th>			
			<th>Fecha</th>
			<th>Operaciones</th>
		</tr>
		@foreach($mensajes as $mensaje)
			<tr {{(($mensaje->leído)? '':'style="font-weight:bold;"')}}>
				<td><a title="Acceda a los detalles del Usuario" href="/admin/usuarios/{{$mensaje->usuario->id}}/ver">{{$mensaje->usuario->nombre .' '. $mensaje->usuario->apellido}}</a></td>
				<td><a title="Visualizar el mensaje" href="/admin/mensajes/{{$mensaje->id}}/ver">{{$mensaje->asunto}}</td>				
				<td>{{date('d/m/Y', strtotime($mensaje->created_at))}}</td>
				<td>
					<a href="/admin/mensajes/{{$mensaje->id}}/cambiarEstado" title="Marque como este mensaje {{(($mensaje->leído)? 'No Leído':'Leído')}}">{{(($mensaje->leído)? 'No Leído':'Leído')}}</a> &nbsp;&nbsp;&nbsp;
					<a href="/admin/mensajes/{{$mensaje->id}}/borrar" title="Elimine el mensaje" onclick="return confirm('¿Está seguro que desea eliminar el mensaje\n«{{$mensaje->asunto}}» de {{$mensaje->usuario->nombre.' '.$mensaje->usuario->apellido}}')" class="rojo">Borrar</a> 
				</td>
			</tr>	
		@endforeach
	</table>
@else
	<div class="mensaje mensaje-notificacion">
		Ud no posee mensajes de sus usuarios.
	</div>
@endif

@stop

