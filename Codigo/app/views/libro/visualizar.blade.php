@extends('template')

@section('contenido')
<h1>Visualización de «{{$libro->título}}»</h1>
<div style="width:850px;">
	<div style="float:left;width:250px;text-align:center;">
		<img src="/public/datos/tapas/{{$libro->tapa}}" alt="Tapa del libro" title="Tapa del libro" width="175" style="box-shadow:10px 8px 10px #ccc; border:1px solid #ccc" />
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
			<td>Autor:</td>
			<td>¿?</td>
		</tr>
		<tr>
			<td>Editorial:</td>
			<td>{{$libro->editorial->nombre}}</td>
		</tr>
		<tr>
			<td>Cantidad de Hojas:</td>
			<td>{{$libro->hojas}}</td>
		</tr>
		<tr>
			<td>Idioma:</td>
			<td>{{$libro->idioma->nombre}}</td>
		</tr>
		<tr>
			<td>Indice:</td>
			<td><a href="/public/datos/indices/{{$libro->índice}}" target="_blank" title="Haga click para visualizar un escaneo del índice del libro">Visualizar índice</a></td>
		</tr>
		<tr>
			<td>Etiquetas:</td>
			<td>¿?</td>
		</tr>
	</table>
	
	</div>
	<br style="clear:both;"/><br/>
<strong>Precio: ${{$libro->precio}}</strong><br/>
<strong>Disponibilidad: {{($libro->agotado)? '<span title="Este libro figura en el catálogo como agotado y no es posible ser comprado." >No</span>':'<span title="Este libro está disponible para compra en el catálogo.">Si</span>'}}</strong>

</div>
	<br/><br/>
	<a href="/admin/libros" title="Retornar a la Gestión de Libros">Volver</a>
@show
