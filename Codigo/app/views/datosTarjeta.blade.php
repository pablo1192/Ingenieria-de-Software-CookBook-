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
        Fecha de vencimiento: <input type=text id="datepicker" name="fecha" size="8" readonly><span class="tooltip" title="Seleccione la fecha de vencimiento de la tarjeta de crédito.">[?]</span> <br/>
        </td>
    </tr>
    </table>
    <br/>
    <input type="submit" class="button button-azul button-mediano" value="Verificar Tarjeta" title="Verifica que la tarjeta sea válida y espera confirmación del usuario." />       
    <a href="/" style="text-decoration:none;">
        <input type="button" class="button button-verde button-mediano" value="Cancelar" title="Cancelar la operacion"/>
    </a>	
</form> 
<script>
    $(function () 
	{
	 //Array para dar formato en español
       $.datepicker.regional['es'] = 
       {
         closeText: 'Cerrar', 
         prevText: 'Previo', 
         nextText: 'Próximo',
  
         monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
         monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
         monthStatus: 'Ver otro mes', yearStatus: 'Ver otro año',
         dayNames: ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'],
         dayNamesShort: ['Dom','Lun','Mar','Mie','Jue','Vie','Sáb'],
         dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'],
         dateFormat: 'dd/mm/yy', firstDay: 0, 
         initStatus: 'Selecciona la fecha', isRTL: false
		}; 
      $.datepicker.setDefaults($.datepicker.regional["es"]);
      $("#datepicker").datepicker
	  ({
        minDate: "+1D",
        maxDate: "+10Y"
      });
    });
</script>
@stop
