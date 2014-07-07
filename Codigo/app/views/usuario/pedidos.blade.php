@extends('template')

@section('ayuda')
    <a href="javascript: void(0)" onclick="popup('/ayuda#pedidos')"><img width="24" src="/template/images/ayuda.png" alt="Ayuda"/></a>
@overwrite

@section('contenido')
<h2>Pedidos vigentes ({{count($pedidos)}}):</h2>

{{-- ToDo: Funciones varias (comprobante, estado, etc). --}}
@if(Session::has('notificacionDeCompra'))
	<div class="mensaje mensaje-notificacion">
		{{Session::get('notificacionDeCompra')}} </br>
		{{Session::forget('notificacionDeCompra')}}
	</div>
@endif
@if(Session::has('notificacionComprobante'))
	<div class="mensaje mensaje-notificacion">
		{{Session::get('notificacionComprobante')}} </br>
		{{Session::forget('notificacionComprobante')}}
	</div>
@endif
@if (count($pedidos) >= 1)
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
				<td width="30%"><strong>Funciones:</strong> <a href="/pedidos/{{ $pedido->id }}/ver" title="Visualizar datos del pedido">Ver Detalle</a> | <a href="/pedidos/{{ $pedido->id }}/comprobante" title="Visualizar comprobante">Ver Comprobante</a> @if ($pedido->estado == "e")
												| <a href="/pedidos/{{ $pedido->id }}/cambiar" title="Cambiar estado" onclick="return confirm('¿Le ha llegado el pedido? Si no es así, aguarde su arribo antes de cambiar el estado.\r\n Esta operación no se puede deshacer.')">Cambiar estado</a>
												@endif</td>
			</tr>
		</table>
		<h2></h2>
		{{-- "Incrementa" la variable contador --}}
		@if ($cont = $cont+1) @endif
	@endforeach
@else
	<div class="mensaje mensaje-notificacion">No posee pedidos vigentes. <a href="/" title="Regresar al catálogo">Haga click aquí para regresar al catálogo.</a></div>
@endif
@stop

