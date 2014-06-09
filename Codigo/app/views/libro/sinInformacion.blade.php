@extends('admin')

@section('menuActivo')
menuActivo='libros'
@stop

@section('contenido')
<a name="area"></a>
<h1>Gestión de libros:</h1>
<h2>Libros con información faltante</h2>
	
@if( ($librosSinEditorial->count()) || ($librosSinAutor->count()) || ($librosSinEtiquetas->count()) || ($librosSinIdioma->count()) )
	<p>Se presentarán a continuación aquellos libros que posean faltante de algunos de sus campos</p>
	@if($librosSinAutor->count())
		<h3>Autor</h3>
		@foreach($librosSinAutor as $libro)
			<ol>
				<li><a href="/admin/libros/{{$libro->id}}/modificar#autores" title="Modificar autores">{{$libro->título}}</li>
			</ol>
		@endforeach
	@endif

	@if($librosSinEditorial->count())
		<h3>Editorial</h3>
		
		@foreach($librosSinEditorial as $libro)
			<ol>
				<li><a href="/admin/libros/{{$libro->id}}/modificar#info" title="Modificar información básica">{{$libro->título}}</li>
			</ol>
		@endforeach
	@endif

	@if($librosSinEtiquetas->count())
		<h3>Etiqueta</h3>
		
		@foreach($librosSinEtiquetas as $libro) <!-- cambio "$librosSinEtiqueta" por "$librosSinEtiquetas" -->
			<ol>
				<li><a href="/admin/libros/{{$libro->id}}/modificar#etiquetas" title="Modificar etiquetas">{{$libro->título}}</li>
			</ol>
		@endforeach
		
	@endif

	@if($librosSinIdioma->count())
		<h3>Idioma</h3>

		@foreach($librosSinIdioma as $libro) <!-- cambio "$librosSinEditorial" por "$librosSinIdioma" -->
			<ol>
				<li><a href="/admin/libros/{{$libro->id}}/modificar#info" title="Modificar información básica">{{$libro->título}}</li>
			</ol>
		@endforeach
	
	@endif

@else
	<p>Actualmente todos sus libros poseen los campos completos.</p>
@endif
<br/>	
<br/>
<a href="/admin/libros" title="Volver al panel de administración">Volver</a>
@stop
