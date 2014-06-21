@extends('template')

@section('contenido')
<h2>Pedidos vigentes ({{count($pedidos)}}):</h2>

{{-- ToDo: Funciones varias (comprobante, estado, etc). --}}

@if (count($pedidos) > 1)
	{{-- "Declara" una variable contador --}}
	@if ($cont = '1') @endif
	@foreach($pedidos as $pedido)
	<h3>Pedido {{$cont}}</h3>
	<table width="100%">
		<tr>
			<td width="10%"><strong>Fecha:</strong> {{$pedido->fecha}}</td>
			<td width="10%"><strong>Estado:</strong> @if($pedido->estado == "p")
											Pendiente
										 @elseif ($pedido->estado == "e")
											Enviado
										 @endif
			</td>
			<td width="30%"><strong>Funciones:</strong> <a href="/pedidos/{{ $pedido->id }}/ver" title="Visualizar datos del pedido">Ver Detalle</a> | <a href="/404" title="Visualizar comprobante">Ver Comprobante</a> @if ($pedido->estado == "e")| <a href="/404" title="Cambiar estado">Cambiar Estado</a> @endif</td>
		</tr>
	</table>
	<h2></h2>
	{{-- "Incrementa" la variable contador --}}
	@if ($cont = $cont+1) @endif
	@endforeach
@else
	<div class="mensaje mensaje-error">No posee pedidos vigentes. <a href="/" title="Regresar al catálogo">Haga click aquí para regresar al catálogo.</a>
@endif
@stop



