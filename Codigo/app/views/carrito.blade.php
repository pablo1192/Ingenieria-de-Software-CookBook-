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
				<td>$ {{$item['precioUnitario']}}</td>
				<td>$ {{$item['precioTotal']}}</td>
				<td>
					<a href="/carrito/{{$id}}/quitar" title="Descuenta una unidad a la cantidad" onclick="return confirm('¿Está Ud seguro que desea quitar 1 unidad de\n«{{$item['titulo']}}»?')">Quitar</a> 					
				</td>			
			</tr>
		@endforeach
		
		<tr class="azul">
			<td style="padding-top:35px;"><strong>Total</strong></td>
			<td style="padding-top:35px;"><strong>{{array_sum(array_pluck($carrito,'cantidad'))}}</strong></td>
			<td style="padding-top:35px;"></td>
			<td style="padding-top:35px;"><strong >$ {{$montoTotal}}</span></td>
			<td></td>
		</tr>
	</table>
<br/>
<br/>
<h2>Operaciones</h2>
<a  href="/carrito/tarjeta"class="button button-azul button-mediano" title="Realice la compra" >Realizar compra</a>
<a  href="/carrito/vaciar"class="button button-verde button-mediano" title="Vacia su carrito de compra" onclick="return confirm('¿Está seguro que desea vaciar su carrito de compras?')">Vaciar carrito</a>

@else
<div class="mensaje mensaje-notificacion">
	Aún no ha añadido libros a su  carrito de compra.
</div>
@endif

@stop
