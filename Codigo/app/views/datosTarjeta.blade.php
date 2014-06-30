@extends('template')

@section('menuActivo')
menuActivo='catalogo'
@stop

@section('contenido')


<h2>Datos de la Tarjeta de Crédito:</h2>
@if($errors->has())
  Errores encontrados: </br>
<ul>
    @foreach($errors->all() as $message)
    <strong><li>{{ $message }}</li></strong>
    @endforeach
</ul>
@endif

El monto final a abonar es de ${{$monto}}.</br></br>
A continuación se le solicitarán los datos de su tarjeta de crédito:</br>
<form method="post" action="/carrito/tarjeta/confirmarCompra">
    <table>
	<tr>
        <td>
        Titular de la Tarjeta de Crédito: <input type=text name="titular" value="" size=""><span class="tooltip" title="Ingrese nombre y apellido del titular de la tarjeta de crédito.">[?]</span> <br/>
        </td>
    </tr>
    <tr>
        <td>
        Número de Tarjeta de Crédito: <input name="numero" value="" placeholder="16 dígitos"><span class="tooltip" title="El número debe contener 16 dígitos.">[?]</span>
        </td>
    </tr>   
    <tr>
        <td>
        Código de verificación: <input type=password name="codigo" value="" size="2"><span class="tooltip" title="El código debe contener solo 3 digitos.">[?]</span>
        </td>
    </tr>
	<tr>
        <td>
        Fecha de vencimiento: <input type=text id="datepicker" name="fechavencimiento" size="8" readonly><span class="tooltip" title="Seleccione la fecha de vencimiento de la tarjeta de crédito.">[?]</span> <br/>
        </td>
    </tr>
    </table>
    <br/>
    <input type="submit" class="button button-azul button-mediano" value="Verificar Tarjeta" title="Verifica que la tarjeta sea válida y espera confirmación del usuario." />       
    <a href="/" style="text-decoration:none;">
        <input type="button" class="button button-verde button-mediano" value="Cancelar" title="Cancelar la operacion"/>
    </a> 
</form> 
@stop
