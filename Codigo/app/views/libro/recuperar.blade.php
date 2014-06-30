@extends('admin')

@section('menuActivo')
menuActivo='libros'
@stop

@section('contenido')
<a name="area"></a>
<h1>Gestión de libros:</h1>
<h2>Restaurar información vinculada a los libros</h2>
@if(Session::has('recuperado'))
	<div class="mensaje mensaje-info">
		{{Session::get('recuperado')}}
	</div>
@endif	
@if( $recuperar )
	<p>Se presentarán a continuación aquellos datos que podrán ser recuperados</p>
	@if($libros->count())
		<a name="libros"></a>
		<h3>Libro</h3>
		@foreach($libros as $libro)
			<ol>
				<li><a href="/admin/libros/{{$libro->id}}/restaurar" onclick="return confirm('¿Esta seguro que desea recuperar \nel libro «{{$libro->título}}»?')" title="Recuperar el libro">{{$libro->título}} </li>
			</ol>
		@endforeach
	@endif
	
	@if($editoriales->count())
		<a name="editoriales"></a>
		<h3>Editorial</h3>
		@foreach($editoriales as $editorial)
			<ol>
				<li><a href="/admin/editoriales/{{$editorial->id}}/restaurar" onclick="return confirm('¿Esta seguro que desea recuperar \nla editorial «{{$editorial->nombre}}»?')" title="Recuperar la editorial">{{$editorial->nombre}}</li>
			</ol>
		@endforeach
	@endif
	
	@if($autores->count())
		<a name="autores"></a>
		<h3>Autor</h3>
		@foreach($autores as $autor)
			<ol>
				<li><a href="/admin/autores/{{$autor->id}}/restaurar" onclick="return confirm('¿Esta seguro que desea recuperar \nal autor «{{$autor->nombre}}»?')" title="Recuperar el autor">{{$autor->nombre}}</li>
			</ol>
		@endforeach
	@endif
	
	@if($etiquetas->count())
		<a name="etiquetas"></a>
		<h3>Etiqueta</h3>
		@foreach($etiquetas as $etiqueta)
			<ol>
				<li><a href="/admin/etiquetas/{{$etiqueta->id}}/restaurar"onclick="return confirm('¿Esta seguro que desea recuperar \nla etiqueta «{{$etiqueta->nombre}}»?')" title="Recuperar la etiqueta">{{$etiqueta->nombre}}</li>
			</ol>
		@endforeach
	@endif
	
	@if($idiomas->count())
		<a name="idiomas"></a>
		<h3>idioma</h3>
		@foreach($idiomas as $idioma)
			<ol>
				<li><a href="/admin/idiomas/{{$idioma->id}}/restaurar" onclick="return confirm('¿Esta seguro que desea recuperar \nal idioma «{{$idioma->nombre}}»?')" title="Recuperar el idioma">{{$idioma->nombre}}</li>
			</ol>
		@endforeach
	@endif



@else
	<p>Actualmente no hay entidades para recuperar.</p>
@endif
<br/>	
<br/>
<a href="/admin/libros" title="Volver al panel de administración">Volver</a>
@stop
