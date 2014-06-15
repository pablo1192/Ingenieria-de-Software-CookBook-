@extends('template')

@section('contenido')
<h2>Pedidos vigentes ({{count($pedidos)}}):</h2>

{{-- ToDo: Separar en dos vistas (general y detallada). | Funciones varias (comprobante, estado, etc). --}}

@if (count($pedidos) > 1)
	{{-- "Declara" una variable contador --}}
	@if ($cont = '1') @endif
	@foreach($pedidos as $pedido)
	<h3>Pedido {{$cont}}</h3>
	<table width="85%" align="center">
		<tr>
			<td width="5%"><strong>Fecha</strong></td>
			<td width="5%"><strong>Monto</strong></td>
			<td width="8%"><strong>Estado</strong></td>
			<td width="35%"><strong>Libros</strong></td>
		</tr>
		<tr>
			<td>{{$pedido->fecha}}</td>
			<td>${{$pedido->monto}}</td>
			@if($pedido->estado == "p")
				<td>Pendiente</td>
			@elseif ($pedido->estado == "e")
				<td>Enviado - SinImpl -> CambioEstado</td>
			@endif
			<td>Sin implementar -> NomDeLibro (cantidad) | NomDeLibro (cantidad)</td>
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
