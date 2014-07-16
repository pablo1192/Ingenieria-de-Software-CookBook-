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
    <form method="get" action="/admin/reportes/">
	  <input type="hidden" name="reporte" value="estado"/>
      <td width="22%">
	  <select name="valor" style="padding:2px;width:250px;" >
		    <option value=""  selected="selected">Elija uno de estos reportes:</option>
			<option value="CantUs">Cantidad de usuarios registrados</option>
			<option value="VenLib">Cantidad de libros vendidos</option>
			<option value="ListaPedidos">Pedidos solicitados</option>
	  </select>
	  </td>
	  <td>
      	desde <input type="text" id="from" name="desde" readonly value="{{Input::get('desde')}}">
	  	hasta <input type="text" id="to" name="hasta" readonly value="{{Input::get('hasta')}}">
	  	<input value="Generar Reporte" type="submit"/>
	  </td>
    </form>
</tr>
</table>


{{--Reporte de Usuarios--}}
@if ((count($datosReporte) >= 1)&&(Session::has('repUserReg')))
<h2>Datos del reporte de usuarios: </h2> 
<table width="30%">
	<tr>
		<th>Fecha de registro</th>
		<th>Nombre</th>
		{{-- <th>Función</th> --}}
	</tr>
@foreach($datosReporte as $dato)
	<tr align="center">
		<td>{{(date('d/m/Y',strtotime($dato->created_at)))}}</td>
		<td><a href="/admin/usuarios/{{ $dato->id }}/ver" title="Ver datos">{{$dato->nombre}} {{$dato->apellido}}</a></td>
		{{-- <td><a href= "/admin/pedidos?filtro=nombre&valor={{ $dato->nombre }}+{{ $dato->apellido }}">Pedidos Activos</a></td> --}}
	</tr>
@endforeach
</table></br>
Total de clientes registrados: {{count($datosReporte)}} {{Session::forget('repUserReg')}}
@else
    @if (Session::has('sinRes'))
     <h1><font color="purple">{{Session::get('sinRes')}}</font></h1>
	 {{Session::forget('sinRes')}}
	@endif 
@endif


{{--Reporte de Libros--}}
@if ((count($datosReporte) >= 1)&&(Session::has('repLibrVen')))
@if ($total = '0') @endif
<h2>Datos del reporte de libros: </h2> 
<table width="40%">
	<tr>
		<th>ISBN</th>
		<th>Título</th>
		<th>Vendidos</th>
	</tr>
@foreach($datosReporte as $dato)
	<tr align="center">
		<td>{{$dato->isbn}}</td>
		<td><a href="/{{$dato->id}}/detalles">{{$dato->título}}</a></td>
		<td>{{$dato->cant}}</td>
		@if ($total = $total+$dato->cant) @endif
	</tr>
@endforeach
</table></br>
Total de libros vendidos: {{$total}} {{Session::forget('repLibrVen')}}
@else
    @if (Session::has('sinRes'))
     <h1><font color="purple">{{Session::get('sinRes')}}</font></h1>
	 {{Session::forget('sinRes')}}
	@endif 
@endif


{{--Reporte de Pedidos--}}
@if ((count($datosReporte) >= 1)&&(Session::has('repPedidos')))
@if ($montoTotal = '0') @endif
<h2>Datos del reporte de pedidos: </h2>
<table width="40%">
	<tr>
		<th>Número</th>
		<th>Fecha</th>
		<th>Cliente</th>
		<th>Monto</th>
		{{-- <th>Función</th> --}}
	</tr>
@foreach($datosReporte as $dato)
	<tr align="center">
		<td><a href= "/admin/pedidos/{{ $dato->id }}/ver">{{$dato->id}}</a></td>
		<td>{{(date('d/m/Y',strtotime($dato->fecha)))}}</td>
		<td><a href="/admin/usuarios/{{ $dato->usuario->id }}/ver" title="Ver datos">{{$dato->usuario->nombre}} {{$dato->usuario->apellido}}</a>
		<td>${{$dato->monto}}</td>
		{{-- <td><a href= "/admin/pedidos/{{ $dato->id }}/ver">Detalles</a></td> --}}
		@if ($montoTotal = $montoTotal+$dato->monto) @endif
	</tr>
@endforeach
</table></br>
Cantidad de pedidos: {{count($datosReporte)}} {{Session::forget('repPedidos')}}</br>
Total recaudado: ${{$montoTotal}}
@else
    @if (Session::has('sinRes'))
     <h1><font color="purple">{{Session::get('sinRes')}}</font></h1>
	 {{Session::forget('sinRes')}}
	@endif 
@endif


{{--Limpia la memoria--}}
@if (Session::has('repUserReg'))
 {{Session::forget('repUserReg')}}
@endif 
@if (Session::has('repLibrVen'))
 {{Session::forget('repLibrVen')}}
@endif 
@if (Session::has('repPedidos'))
 {{Session::forget('repPedidos')}}
@endif 


{{--Datepicker--}}
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
			changeYear: true,
			onClose: function( selectedDate ) {
				$( "#to" ).datepicker( "option", "minDate", selectedDate );
			}
		});
	  $( "#to" ).datepicker({
			defaultDate: "+1w",
			changeMonth: true,
			changeYear: true,
			onClose: function( selectedDate ) {
				$( "#from" ).datepicker( "option", "maxDate", selectedDate );
			}
		});
	});
</script> 
@stop 