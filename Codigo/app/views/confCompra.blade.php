@extends('template')
@section('contenido')

<h2>Confirmación de compra final</h2>
¡Su tarjeta ha sido validada con éxito! </br>
El monto final a abonar es de ${{$monto}}.</br></br>
Se encuentra a punto de hacer efectiva la compra. ¿Está seguro que desea continuar?<br/>
<form method="post" action="/carrito/tarjeta/finalizarCompra">
	<input type="submit" class="button button-azul button-mediano" value="Confirmar compra" title="Realice la compra" /> 
	<a  href="/"class="button button-verde button-mediano" title="Cancela la compra" >Cancelar</a>
</form>
@stop
