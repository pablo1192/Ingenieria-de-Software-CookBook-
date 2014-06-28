<h2>Comprobante de compra emitido por Cookbook</h2>
<hr />
<h3>Datos generales de la compra </h3>
<table width="90%">
    <tr>		
		<td><strong>Pedido número:</strong> {{$pedido->id}}</td>
	</tr>
	<tr>		
		<td><strong>Cliente:</strong> {{$pedido->usuario->nombre}} {{$pedido->usuario->apellido}}
	</tr>
	<tr>		
		<td><strong>Fecha de compra:</strong> {{$pedido->fecha}}</td>
	</tr>
	<tr>		
		<td><strong>Monto final a abonar:</strong> ${{$pedido->monto}}</td>
	</tr>
	<tr>		
		<td><strong>Dirección de envío:</strong> {{$pedido->usuario->dirección}}</td>
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
<hr/><h4>La compra será enviada a la dirección de envío antes mencionada a través del Correo Argentino.</br>
Para hacer efectiva la entrega del pedido, se le solicitará al comprador su DNI. Si la compra es por contrareembolso, se le solicitirá el pago.</h4><hr/>
<h2></h2>	
<a href="/admin/pedidos" style="text-decoration:none;">
        <input type="button" class="button button-verde button-mediano" value="Volver" title="Regresa a los pedidos"/>
</a>
<a href="/admin/pedidos" style="text-decoration:none;">
        <input type="button" class="button button-azul button-mediano" value="Imprimir comprobante" onClick="window.print()" title="Imprime el comprobante" /> 
</a>	