@extends('template')

@section('menuActivo')
menuActivo='catalogo'
@stop

@section('contenido')


<h2>Datos de la Tarjeta de Crédito:</h2>
<ul>
@if($errors->has()||Session::has('venc'))
  Errores encontrados: </br>
@endif
@if($errors->has())
    @foreach($errors->all() as $message)
    <strong><li>{{ $message }}</li></strong>
    @endforeach
@endif
@if(Session::has('venc'))
  <strong>-> {{Session::get('venc')}}</strong></br></br>
  {{Session::forget('venc')}}
@endif
</ul>
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
      {{--  Fecha de vencimiento: <input type=text id="datepicker" name="fecha" size="8" readonly><span class="tooltip" title="Seleccione la fecha de vencimiento de la tarjeta de crédito.">[?]</span> <br/>--}}
        </td>
    </tr>
    </table>
	<table>
	   <tr>
	      <td>
            <input type="hidden" name="selMes" value="mes"/> Seleccione la fecha de vencimiento<span class="tooltip" title="Seleccione la fecha de vencimiento de la tarjeta de crédito.">[?]</span> 
		    <select name="valorMes" style="padding:2px;width:105px;" >
				    {{--<option value=""  selected="selected"> Mes </option>--}}
					<option value="01">Enero</option>
					<option value="02">Febrero</option>
					<option value="03">Marzo</option>
					<option value="04">Abril</option>
					<option value="05">Mayo</option>
					<option value="06">Junio</option>
					<option value="07">Julio</option>
					<option value="08">Agosto</option>
					<option value="09">Septiembre</option>
					<option value="10">Octubre</option>
					<option value="11">Noviembre</option>
					<option value="12">Diciembre</option>
			</select>
		</td>
		<td><input type="hidden" name="selAnio" value="Anio"/> 
			<select name="valorAnio" style="padding:2px;width:95px;" >
				   {{-- <option value=""  selected="selected"> Año </option>  --}}
					<option value="2014">2014</option>
					<option value="2015">2015</option>
					<option value="2016">2016</option>
					<option value="2017">2017</option>
					<option value="2018">2018</option>
					<option value="2019">2019</option>
					<option value="2020">2020</option>
					<option value="2021">2021</option>
			</select>
        </td>
	   </tr>
	</table>
    <input type="submit" class="button button-azul button-mediano" value="Verificar Tarjeta" title="Verifica que la tarjeta sea válida y espera confirmación del usuario." />       
    <a href="/" style="text-decoration:none;">
        <input type="button" class="button button-verde button-mediano" value="Cancelar" title="Cancelar la operacion"/>
    </a>	
</form>
<!-- <script>
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
</script> -->

@stop
