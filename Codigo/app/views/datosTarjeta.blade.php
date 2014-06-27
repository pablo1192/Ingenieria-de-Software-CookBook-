@extends('template')

@section('menuActivo')
menuActivo='catalogo'
@stop

@section('contenido')
@if($errors->has())
  Errores encontrados: </br>
<ul>
    @foreach($errors->all() as $message)
    <li>{{ $message }}</li>
    @endforeach
</ul>
@endif

<h2>Datos de la Tarjeta de Crédito:</h2>
El monto final a abonar es de ${{$monto}}.</br></br>
A continuación se le solicitarán los datos de su tarjeta de crédito:
<form method="get" action="/carrito/tarjeta/confirmarCompra/">
    <table>
    <tr>
        <td>
        Número de Tarjeta de Crédito: <input name="numero" value="" ><span class="tooltip" title="El número debe contener 16 dígitos.">[?]</span>
        </td>
    </tr>   
    <tr>
        <td>
        Código de verificación: <input type=password name="contraseña" value="" size="1"><span class="tooltip" title="El código debe contener solo 3 digitos.">[?]</span>
        </td>
    </tr>
    <tr>
        <td>
        Reescriba el código: <input type=password name="contraseña_confirmation" value="" size="1"><span class="tooltip" title="Repita el código de verificación.">[?]</span> <br/>
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
