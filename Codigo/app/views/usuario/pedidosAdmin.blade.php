@extends('admin')

@section('menuActivo')
menuActivo='pedidos'
@stop

@section('contenido')
<h2>Pedidos vigentes ({{count($pedidos)}}):</h2>

{{-- ToDo: Funciones varias (comprobante, estado, etc). --}}

@if (count($pedidos) >= 1)
	{{-- "Declara" una variable contador --}}
	@if ($cont = '1') @endif
	@foreach($pedidos as $pedido)
		<h3>Pedido {{$cont}}</h3>
		<table width="100%">
			<tr>
				<td width="8%"><strong>Fecha:</strong> {{$pedido->fecha}}</td>
				<td width="10%"><strong>Cliente:</strong> <a href="/admin/usuarios/{{ $pedido->usuario->id }}/ver" title="Ver datos">{{$pedido->usuario->nombre}} {{$pedido->usuario->apellido}}</a></td>
				<td width="8%"><strong>Estado:</strong> @if($pedido->estado == "p")
												Pendiente
											 @elseif ($pedido->estado == "e")
												Enviado
											 @endif
				</td>
				<td width="30%"><strong>Funciones:</strong> <a href="/admin/pedidos/{{ $pedido->id }}/ver" title="Visualizar datos del pedido">Ver Detalle</a> | <a href="/404" title="Visualizar comprobante">Ver Comprobante</a> | 
				@if ($pedido->estado == "p")
					<a href="/pedidos/{{ $pedido->id }}/cambiar" title="Cambiar estado">Cambiar a Enviado</a></td>
				@else
					<a href="/pedidos/{{ $pedido->id }}/cambiar" title="Cambiar estado" onclick="return confirm('¿Le ha llegado el pedido al cliente? Si no es así, aguarde una confirmación antes de cambiar el estado.\r\n Esta operación no se puede deshacer.')">Cambiar a Finalizado</a></td>
				@endif
			</tr>
		</table>
		<h2></h2>
		{{-- "Incrementa" la variable contador --}}
		@if ($cont = $cont+1) @endif
	@endforeach
<h2>Funciones:</h2>
Ordenar por fecha.</br>
Buscar por nombre.</br>
Buscar por estado.
@else
	<div class="mensaje mensaje-notificacion">No posee pedidos vigentes. <a href="/" title="Regresar al catálogo">Haga click aquí para regresar al catálogo.</a></div>
@endif
@stop



