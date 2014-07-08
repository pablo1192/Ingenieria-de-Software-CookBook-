@extends('admin')

@section('ayuda')
    <a href="javascript: void(0)" onclick="popup('/admin/ayuda#pedidos')"><img width="24" src="/template/images/ayuda.png" alt="Ayuda"/></a>
@overwrite

@section('menuActivo')
menuActivo='reportes'
@stop

@section('contenido')</br></br>
<ul>
@if($errors->has()||Session::has('rep'))
  Errores encontrados: </br>
@endif
@if($errors->has())
    @foreach($errors->all() as $message)
    <strong><li>{{ $message }}</li></strong>
    @endforeach
@endif
@if(Session::has('rep'))
  <strong>-> {{Session::get('rep')}}</strong></br></br>
  {{Session::forget('rep')}}
@endif
</ul>
En esta sección usted podrá generar distintos reportes.</br></br>
<table width="100%" style="margin-bottom:8px;">
<tr>
	<td width="0%">
	    <form method="GET" action="/admin/reportes/">
		  <input type="hidden" name="reporte" value="estado"/>
		    <td>
			<select name="valor" style="padding:2px;width:250px;" >
				    <option value=""  selected="selected"> Elija uno de estos reportes: </option>
					<option value="CantUs">Cantidad de usuarios registrados </option>
					<option value="VenLib">Venta de libros </option>
			</select><span class="tooltip" title="Seleccione el tipo de reporte a mostrar.">&nbsp;[?]</span>
			</td>
	</td>
	<td>
	       desde <input type="text" id="from" name="desde" readonly value="{{Input::get('desde')}}">
		   hasta <input type="text" id="to" name="hasta" readonly value="{{Input::get('hasta')}}">
		   <input value="Generar Reporte" type="submit"/> <span class="tooltip" title="Genere el reporte.">[?]</span>
        </form>
	</td>	
</tr>
</table>
@if (count($datosReporte) >= 1)
<h2>Datos del reporte: </h2> 
<table>
	<tr>
		<th>Fecha de registro</th>
		<th>Nombre</th>
	</tr>
@foreach($datosReporte as $dato)
	<tr>
		<td width="70%">{{$dato->created_at}}</td>
		<td><a href="/admin/usuarios/{{ $dato->id }}/ver" title="Ver datos">{{$dato->nombre}} {{$dato->apellido}}</a></td>
	</tr>
@endforeach
</table></br>
Total de clientes: {{count($datosReporte)}}
@else
    @if (Session::has('sinRes'))
     <h1><font color="purple">{{Session::get('sinRes')}}</font></h1>
	 {{Session::forget('sinRes')}}
	@endif 
@endif    
<script>
	$(function() {
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
         dateFormat: 'yy/mm/dd', firstDay: 0, 
         initStatus: 'Selecciona la fecha', isRTL: false
		}; 
      $.datepicker.setDefaults($.datepicker.regional["es"]);
	  $( "#from" ).datepicker({
			defaultDate: "+1w",
			changeMonth: true,
			onClose: function( selectedDate ) {
				$( "#to" ).datepicker( "option", "minDate", selectedDate );
			}
		});
	  $( "#to" ).datepicker({
			defaultDate: "+1w",
			changeMonth: true,
			onClose: function( selectedDate ) {
				$( "#from" ).datepicker( "option", "maxDate", selectedDate );
			}
		});
	});
</script> 
@stop 