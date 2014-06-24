@extends('template')
@section('contenido')

<h2>Confirmación de compra final</h2>
La tarjeta ha sido validada con éxito! </br>
El monto a abonar es de ${{$monto}}.</br></br>
Estás a punto de realizar la compra, ¿Estás seguro que deseas continuar?<br/>
<form method="post" action="/carrito/tarjeta/confirmarCompra">
	<input type="submit" class="button button-azul button-mediano" value="Confirmar compra" title="Realice la compra" /> 
	<a  href="/"class="button button-verde button-mediano" title="Cancela la compra" >Cancelar</a>
</form>
@stop
