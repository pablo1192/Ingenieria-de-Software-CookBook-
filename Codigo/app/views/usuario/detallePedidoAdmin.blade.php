@extends('admin')

@section('menuActivo')
menuActivo='pedidos'
@stop

@section('contenido')
<h2>Información de Pedido</h2>

<table width="90%">
	<tr>		
		<td><strong>Cliente:</strong> <a href="/admin/usuarios/{{ $pedido->usuario->id }}/ver" title="Ver datos">{{$pedido->usuario->nombre}} {{$pedido->usuario->apellido}}</a>
		@if (($pedido->usuario->bloqueado) OR ($pedido->usuario->dadoDeBaja))
					<strong><font color="red"><span class="tooltip" title="El usuario ha sido bloqueado o dado de baja. Usted deberá cambiar el estado del pedido manualmente.">- Inactivo [?]</span></font></strong>
		@endif</td>
	</tr>
	<tr>		
		<td><strong>Fecha:</strong> {{$pedido->fecha}}</td>
	</tr>
	<tr>		
		<td><strong>Monto:</strong> ${{$pedido->monto}}</td>
	</tr>
	<tr>		
		<td><strong>Estado:</strong> @if($pedido->estado == "p")
										Pendiente
									 @endif
									 @if($pedido->estado == "e")
										Enviado
									 @endif
									 @if($pedido->estado == "f")
										Finalizado
									 @endif
		</td>
	</tr>
</table>

<h2>Libros solicitados</h2>
	<table width="55%">
		@foreach ($pedido->libros as $libro)
		<tr>
			<td><strong>Título:</strong> <a href="/{{$libro->id}}/detalles">{{$libro->título}}</a></td>
			<td><strong>Precio unitario:</strong> ${{$libro->precio}}</td>
			<td><strong>Cantidad:</strong> {{$libro->pivot->cantidad}}</td>
		</tr>
		@endforeach
	</table>

<h2></h2>	
<a href="/admin/pedidos">Volver a la lista de pedidos.</a>
@stop
