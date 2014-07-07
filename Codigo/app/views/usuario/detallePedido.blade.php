@extends('template')

@section('ayuda')
    <a href="javascript: void(0)" onclick="popup('/ayuda#pedidos')"><img width="24" src="/template/images/ayuda.png" alt="Ayuda"/></a>
@overwrite

@section('contenido')
<h2>Información de Pedido</h2>

<table width="90%">
	<tr>		
		<td><strong>Fecha:</strong> {{$pedido->fecha}}</td>
	</tr>
	<tr>		
		<td><strong>Monto:</strong> ${{$pedido->monto}}</td>
	</tr>
	<tr>		
		<td><strong>Estado:</strong> @if($pedido->estado == "p")
										Pendiente
									 @elseif ($pedido->estado == "e")
										Enviado
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
<a href="/pedidos">Volver a la lista de pedidos.</a>
@stop
