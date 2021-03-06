@extends('admin')

@section('ayuda')
    <a href="javascript: void(0)" onclick="popup('/admin/ayuda#libros')"><img width="24" src="/template/images/ayuda.png" alt="Ayuda"/></a>
@overwrite

@section('menuActivo')
menuActivo='libros'
@stop

@section('contenido')
<h1>Gestión de libros</h1>
<h2>Visualización de «{{$libro->título}}»</h2>
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
<strong>Precio: ${{$libro->precio}}</strong><br/>
<strong>Disponibilidad: {{($libro->agotado)? '<span title="Este libro figura en el catálogo como agotado y no puede ser comprado." >No</span>':'<span title="Este libro está disponible para comprarlo en el catálogo.">Sí</span>'}}</strong>

</div>
	<br/><br/>
	<a href="/admin/libros/" title="Retornar a la Gestión de Libros">Volver</a>
@stop
