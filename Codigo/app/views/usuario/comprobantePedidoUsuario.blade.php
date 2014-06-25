
<h2>Comprobante de compra emitido por Cookbook</h2>
<hr />
<h3>Datos generales de la compra </h3>
<hr />
<table width="90%">
    <tr>		
		<td><strong>Pedido número:</strong> {{$pedido->id}}</td>
	</tr>
	<tr>		
		<td><strong>Cliente:</strong> {{$pedido->usuario->nombre}} {{$pedido->usuario->apellido}}
	</tr>
	<tr>		
		<td><strong>Fecha de Compra:</strong> {{$pedido->fecha}}</td>
	</tr>
	<tr>		
		<td><strong>Monto final a abonar:</strong> ${{$pedido->monto}}</td>
	</tr>
</table>
<hr />
<h3>Detalles de la compra</h3>
<table width="55%" border="1">
	<tr>
		<th>Título</th>	
		<th>Precio Unitario</th>
		<th>Cantidad</th>
	</tr>
@foreach($pedido->libros as $libro)
	<tr align = "center">
		<td>{{$libro->título}}</td>
		<td>${{$libro->precio}}</td>		
		<td>{{$libro->pivot->cantidad}}</td>				
	</tr>

@endforeach
</table>

<h2></h2>	
<a href="/pedidos" style="text-decoration:none;">
        <input type="button" class="button button-verde button-mediano" value="Volver" title="Regresa a los pedidos"/>
</a>
<a href="/pedidos" style="text-decoration:none;">
        <input type="button" class="button button-azul button-mediano" value="Imprimir comprobante" onClick="window.print()" title="Imprime el comprobante" /> 
</a>		
