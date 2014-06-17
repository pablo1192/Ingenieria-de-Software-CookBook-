@extends('template')

@section('menuActivo')
menuActivo='catalogo'
@stop

@section('contenido')
<a name="area"></a>
<h2>Carrito de compras</h2>
@if($carrito)
	<table width="900px">
		<tr align="left">
			<th>Libro</th>
			<th>Cantidad</th>
			<th>Precio unitario</th>
			<th>Total</th>
			<th>Operaciones</th>			
		</tr>
		@foreach($carrito as $id=>$item)
			
			<tr>
				<td><a href="/{{$id}}/detalles"title="Visualizar «{{$item['titulo']}}»">{{$item['titulo']}}</a></td>
				<td>{{$item['cantidad']}}</td>
				<td>{{$item['precioUnitario']}}</td>
				<td>{{$item['precioTotal']}}</td>
				<td>
					<a href="/carrito/quitar/{{$id}}" title="Descuenta una unidad a la cantidad">Quitar</a> 					
				</td>			
			</tr>
		@endforeach
	</table>
<br/>
<br/>
<h2>Operaciones</h2>
<a  href="/carrito/vaciar"class="button button-verde button-mediano" title="Vacia su carrito de compra" onclick="return confirm('¿Está seguro que desea vaciar su carrito de compras?')">Vaciar carrito</a>

@else
<div class="mensaje mensaje-notificacion">
	Aún no ha añadido libros a su  carrito de compra.
</div>
@endif

@stop
