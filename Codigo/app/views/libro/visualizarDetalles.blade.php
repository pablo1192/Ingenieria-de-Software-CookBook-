@extends('template')

@section('ayuda')
    <a href="javascript: void(0)" onclick="popup('/ayuda#catalogo')"><img width="24" src="/template/images/ayuda.png" alt="Ayuda"/></a>
@overwrite

@section('menuActivo')
menuActivo='catalogo'
@stop

@section('contenido')
<h1>Detalles de «{{$libro->título}}»</h1>
<div style="width:850px;">
	<div style="float:left;width:250px;text-align:center;">
		<img src="/datos/tapas/{{$libro->tapa}}" alt="Tapa del libro" title="Tapa del libro" width="175" style="box-shadow:10px 8px 10px #ccc; border:1px solid #ccc" />
	</div>
	<div style="float:right;">
	<table width="100%" style="vertical-align:left;">
		<tr>		
			<td>ISBN:</td>
			<td>{{$libro->isbn}}</td>
		</tr>
		<tr>
			<td>Título:</td>
			<td>{{$libro->título}}</td>
		</tr>
		<tr>
			<td>{{(($libro->autores->count() > 1)? 'Autores': 'Autor')}}:</td>
			<td>{{implode(', ',array_pluck($libro->autores,'nombre'))}}</td>
		</tr>
		<tr>
			<td>Editorial:</td>
			<td>{{$libro->editorial->nombre}}</td>
		</tr>
		<tr>
			<td>Año de Edición:</td>
			<td>{{$libro->añoEdición}}</td>
		</tr>
		<tr>
			<td>Cantidad de hojas:</td>
			<td>{{$libro->hojas}}</td>
		</tr>
		<tr>
			<td>Idioma:</td>
			<td>{{$libro->idioma->nombre}}</td>
		</tr>
		<tr>
			<td>Índice:</td>
			<td><a href="/datos/indices/{{$libro->índice}}" target="_blank" title="Haga click para visualizar un escaneo del índice del libro.">Visualizar índice</a></td>
		</tr>
		<tr>
			<td>{{(($libro->etiquetas->count() > 1)? 'Etiquetas': 'Etiqueta')}}:</td>
			<td>{{implode(', ',array_pluck($libro->etiquetas,'nombre'))}}</td>
		</tr>
	</table>
	</div>
	<br style="clear:both;"/><br/>
	<div style="float:left;">
		<strong>Precio: ${{$libro->precio}}</strong><br/>
		<strong>Disponibilidad: {{($libro->agotado)? '<span title="Este libro figura en el catálogo como agotado y no puede ser comprado." >No</span>':'<span title="Este libro está disponible para comprarlo en el catálogo.">Sí</span>'}}</strong>
	</div>
	<div style="float:right;margin-right:80px;">
		@if((!$libro->agotado) && (!Auth::user()->esAdmin))
		<form method="POST" action="/carrito">
			<input type="hidden" name="id" value="{{$libro->id}}">
			<input type="submit" class="button button-verde button-mediano" value="Agregar al carrito">
		</form>
		@elseif ($libro->agotado) 
			<div class="mensaje mensaje-error">El libro se encuentra agotado en este momento.</div>
		@endif
	</div>
	<br style="clear:both;"/><br/>
</div>
@if(Session::has('agregado'))
	<div class="mensaje mensaje-notificacion">
		{{Session::get('agregado')}} </br><a href="/carrito" title="Dirigirse al carrito">Haga click aquí para ver su carrito de compras ({{(Session::has('carrito'))? array_sum(Session::get('carrito')) : 0 }})</a>
	</div>
@endif
	<br/><br/>
	<a href="/" title="Retornar al catálogo">Volver al catálogo</a>
@stop
