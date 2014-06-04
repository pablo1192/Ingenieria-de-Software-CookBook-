@extends('admin')

@section('menuActivo')
menuActivo='libros'
@stop

@section('contenido')
<h1>Gestión de libros</h1>
<h2>Modificación de «{{$libro->título}}»</h2>
<p>Modifique las secciones del libro que le interesa</p>
@if($errors->any())
<div class="mensajeDeError">
	<p>Error al intentar modificar el libro:</p>
	<ul>
		@foreach(($errors->all()) as $mensajeDeError)
		<li>{{$mensajeDeError}}</li>
		@endforeach
	</ul>
</div>
@endif

<a name="info"></a>
<h3>Información básica</h3>
	<form method="post" action="/admin/libros/{{$libro->id}}/modificar">
		<table width="70%" style="vertical-align:left;">
			<tr>		
				<td style="width:150px;">ISBN:</td>
				<td><input maxlength="13" value="{{$libro->isbn}}" name="isbn"/> <span class="tooltip" title="El ISBN es un número de 10 a 13 dígitos.">[?]</span></td>
			</tr>
			<tr>
				<td style="width:150px;">Título:</td>
				<td><input size="64" value="{{$libro->título}}" name="titulo"/> <span class="tooltip" title="El título debe contener sólo letras y números, y debe ser de longitud mayor a 2.">[?]</span></td>
			</tr>
			<tr>
				<td style="width:150px;">Editorial: <span class="tooltip" title="Seleccione una editorial de la lista.">[?]</span><br/>
					<span title="Valor actual" ><i>{{$libro->editorial->nombre}}</i></span>
				</td>
				<td>
					<select name="editorial">
						@foreach($editoriales as $editorial)
							<option value="{{$editorial->id}}">{{$editorial->nombre}}</option>
						@endforeach
					</select>
					<input name="editorial-checkbox"  type="checkbox" title="Habilitar la creación de una nueva editorial" onchange="habilitarOtro(this,'editorial-otro'); deshabilitarSeleccion(this,'editorial');"/>Otra: 
					<input id="editorial-otro" name="editorial-otro" value="{{Input::old('editorial-otro')}}" disabled placeholder="Sudamericana" /><span class="tooltip" title="Tilde 'Otro' para crear una editorial que no se encuentra en la lista.">[?]</span>
					<br/>
					<br/>
				</td>
			</tr>
			<tr>
				<td style="width:150px;">Año de edición:</td>
				<td><input size="8" maxlength="4" value="{{$libro->añoEdición}}" name="anoDeEdicion"/> <span class="tooltip" title="Ingrese un número entre 1900 y 2014">[?]</span></td>
			</tr>
			<tr>
				<td style="width:150px;">Precio:</td>
				<td><input size="8" value="{{$libro->precio}}" name="precio"/> <span class="tooltip" title="El precio debe respetar el siguiente formato: como máximo 4 dígitos enteros y 2 dígitos decimales separados por punto. Por ejemplo: 22.99">[?]</span> </td>
			</tr>
			<tr>
				<td style="width:150px;">Cantidad de hojas:</td>
				<td><input maxlength="4" size="8" value="{{$libro->hojas}}" name="hojas"/> <span class="tooltip" title="La cantidad de hojas debe ser un número entero entre 10 y 9999.">[?]</span></td>
			</tr>
			<tr>
				<td style="width:150px;">Idioma: <span class="tooltip" title="Seleccione un idioma de la lista.">[?]</span><br/>
				<span title="Valor actual"><i>{{$libro->idioma->nombre}}</i></span>
				</td>
				<td>
					<select name="idioma" >
						@foreach($idiomas as $idioma)
							<option value="{{$idioma->id}}">{{$idioma->nombre}}</option>
						@endforeach
					</select>
					<input name="idioma-checkbox" type="checkbox" title="Habilitar la creación de un nuevo idioma" onchange="habilitarOtro(this,'idioma-otro'); deshabilitarSeleccion(this,'idioma')"/>Otro: 
					<input id="idioma-otro" name="idioma-otro" value="{{Input::old('idioma-otro')}}"  disabled placeholder="Chino Mandarín"/><span class="tooltip" title="Tilde 'Otro' para crear un idioma que no se encuentra en la lista.">[?]</span><br/><br/>
				</td>
			</tr>
		</table>		
		<input type="hidden" name="modificar" value="info">
		<input type="submit" value="Modificar" title="Realiza los cambios solicitados"/>			
		<a href="/admin/libros/" style="text-decoration:none;"><input type="button" value="Cancelar" title="Cancela la operación"/></a>
	</form>	
	
<br/><br/>
<a name="autores"></a>
<h3>Autores</h3>
<form method="post" action="/admin/libros/{{$libro->id}}/modificar">
	<ul>
	@foreach($libro->autores as $autor)
		<li>{{$autor->nombre}}</li>
	@endforeach
	</ul>
	<input type="hidden" name="modificar" value="autores">
	<input type="submit" value="Modificar" title="Realiza los cambios solicitados"/>			
	<a href="/admin/libros/" style="text-decoration:none;"><input type="button" value="Cancelar" title="Cancela la operación"/></a>
</form>
<br/><br/>
<a name="etiquetas"></a>
<h3>Etiquetas</h3>
<form method="post" action="/admin/libros/{{$libro->id}}/modificar">

		<input type="hidden" name="modificar" value="etiquetas">
		<input type="submit" value="Modificar" title="Realiza los cambios solicitados"/>			
		<a href="/admin/libros/" style="text-decoration:none;"><input type="button" value="Cancelar" title="Cancela la operación"/></a>
</form>
<br/><br/>
<a name="archivos"></a>
<h3>Tapa e índice del libro</h3>

	<div style="float:left;width:250px;text-align:center;">
		<img src="/datos/tapas/{{$libro->tapa}}" alt="Tapa del libro" title="Tapa del libro" width="175" style="box-shadow:10px 8px 10px #ccc; border:1px solid #ccc" />
		<br/>
		<form action="/admin/libros/{{$libro->id}}/modificar" method="post" accept-charset="UTF-8" enctype="multipart/form-data">
			<input type="hidden" value="modTapa"/>
			<input type="submit" value="modTapa"/>
			<input type="file" value="Cambiar"  accept="image/*"/>
		</form>
	</div>
	<div style="float:right;">

	
	</div>
	<br style="clear:both;"/><br/>
</div>
	<br/><br/>
	<a href="/admin/libros/" title="Retornar a la Gestión de Libros">Volver</a>
	
<script src="/scripts/formularioLibro.js">Requiere tener activado JavaScript para el correcto funcionamiento del formulario!</script>
@stop
