@extends('admin')

@section('ayuda')
    <a href="javascript: void(0)" onclick="popup('/admin/ayuda#contacto')"><img width="24" src="/template/images/ayuda.png" alt="Ayuda"/></a>
@overwrite

@section('contenido')
<h1>Gestión de Mensajes</h1>

<h2>Visualización</h2>
	<table width="900px" cellspacing="5px">
		<tr>
			<td width="70px">Usuario:</td><td> <a title="Acceda a los detalles del Usuario" href="/admin/usuarios/{{$mensaje->usuario->id}}/ver">{{$mensaje->usuario->nombre .' '. $mensaje->usuario->apellido}}</a></td>
		</tr>	
			<td width="70px">Asunto:</td><td><a title="Visualice el mensaje" href="">{{$mensaje->asunto}}</td>				
		</tr>	
			<td width="70px">Fecha:</td><td>{{date('d/m/Y H:m', strtotime($mensaje->created_at))}}</td>
		</tr>	
		<tr>				
			<td style="border-top:1px solid #ccc;border-bottom:1px solid #ccc;padding-top:5px;" colspan="2">
				{{$mensaje->cuerpo}}
			</td>	
		</tr>	
	</table>
	<br/>
	<a href="mailto:{{$mensaje->usuario->email}}?subject=Re:{{$mensaje->asunto}}" title="Responda vía mail a este mensaje" class="button button-mediano button-verde">Responder</a> &nbsp;&nbsp;&nbsp;
	<a href="/admin/mensajes/{{$mensaje->id}}/borrar" title="Elimine este mensaje" class="button button-mediano button-rojo" onclick="return confirm('¿Está seguro que desea eliminar el mensaje\n«{{$mensaje->asunto}}» de {{$mensaje->usuario->nombre.' '.$mensaje->usuario->apellido}}')">Borrar</a>
	<br/><br/>
	<a title="Retornar a Gestión de Mensajes" href="/admin/mensajes">Volver</a>
@stop

