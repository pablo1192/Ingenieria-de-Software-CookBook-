@extends('admin')

@section('ayuda')
    <a href="javascript: void(0)" onclick="popup('/admin/ayuda#contacto')"><img width="24" src="/template/images/ayuda.png" alt="Ayuda"/></a>
@overwrite

@section('contenido')
<h1>Gestión de Mensajes</h1>

<h2>Mensajes (<span title="Cantidad total de mensajes">{{count($mensajes)}}</span>):</h2>
	<table align="right" width="400px">
		<tr>
			<td>
				@if($filtrar)
					Estas filtrando por <a href="/admin/mensajes" title="Haga click para quitar el filtro">{{$criterio}}</a>
				@endif
			</td>
			<td width="150px">
				<form method="get" action="/admin/mensajes">
					<select name="filtrar" style="padding:2px;width:150px;" onchange="this.form.submit();">
						<option selected>Filtrar Mensajes</option>
						<option value="leidos">Leídos</option>
						<option value="noLeidos">No leídos</option>
					</select>
				</form>
			</td>
		</tr>
	</table>

@if(count($mensajes))
	@if(Session::get('mensajeEliminado'))
	<div class="mensaje mensaje-info">
		{{Session::get('mensajeEliminado')}}
	</div>
	@endif
	
	<table width="950px" cellspacing="0" cellpadding="3">
		<tr align="left">
			<th>Usuario</th>
			<th>Asunto</th>			
			<th>Enviado</th>
			<th>Operaciones</th>
		</tr>
		@foreach($mensajes as $mensaje)
			<tr style="padding:5px 2px;{{(($mensaje->leído)? '':'font-weight:bold;background-color:#F0F4FF;')}}">
				<td><a title="Acceda a los detalles del Usuario" href="/admin/usuarios/{{$mensaje->usuario->id}}/ver">{{$mensaje->usuario->nombre .' '. $mensaje->usuario->apellido}}</a></td>
				<td><a title="Visualizar el mensaje" href="/admin/mensajes/{{$mensaje->id}}/ver">{{$mensaje->asunto}}</td>				
				<td width="210px">{{date('d/m/Y H:i:s', strtotime($mensaje->created_at))}}</td>
				<td width="230px">
					<a href="mailto:{{$mensaje->usuario->email}}?subject=Re:{{$mensaje->asunto}}" title="Responda vía mail a este mensaje" class="azul">Responder</a> &nbsp;
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

