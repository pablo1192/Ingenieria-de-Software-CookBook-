@extends('admin')

@section('ayuda')
    <a href="javascript: void(0)" onclick="popup('/admin/ayuda#libros')"><img width="24" src="/template/images/ayuda.png" alt="Ayuda"/></a>
@overwrite

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
				<td><input size="64" value="{{$libro->título}}" name="titulo"/> <span class="tooltip" title="El título debe contener sólo letras y números, y debe ser de longitud mayor a 2.">[?]</span><br/><br/></td>
			</tr>
			<tr>
				<td style="width:150px;">Editorial: <span class="tooltip" title="Seleccione una editorial de la lista.">[?]</span><br/>
					<span title="Valor actual" ><i>{{$libro->editorial->nombre}}</i></span>
				</td>
				<td>
					<select style="width:30%; padding: 0.50em 0.5em; margin: 0.50em 0.5em" name="editorial">
						<option value="{{$libro->editorial->id}}" select="selected" >Selecione una editorial</option>
						@foreach($editoriales as $editorial)
							<option value="{{$editorial->id}}">{{$editorial->nombre}}</option>
						@endforeach
					</select>
					<input name="editorial-checkbox"  type="checkbox" title="Habilitar la creación de una nueva editorial" onchange="habilitarOtro(this,'editorial-otro'); deshabilitarSeleccion(this,'editorial');"/>Otra: 
					<input id="editorial-otro" name="editorial-otro" value="{{Input::old('editorial-otro')}}" disabled placeholder="Sudamericana" /><span class="tooltip" title="Tilde 'Otro' para crear una editorial que no se encuentra en la lista.">[?]</span><br/><br/>
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
				<td><input maxlength="4" size="8" value="{{$libro->hojas}}" name="hojas"/> <span class="tooltip" title="La cantidad de hojas debe ser un número entero entre 10 y 9999.">[?]</span><br/><br/></td>
			</tr>
			<tr>
				<td style="width:150px;">Idioma: <span class="tooltip" title="Seleccione un idioma de la lista.">[?]</span><br/>
				<span title="Valor actual"><i>{{$libro->idioma->nombre}}</i></span>
				</td>
				<td>
					<select style="width:30%; padding: 0.50em 0.5em; margin: 0.50em 0.5em" name="idioma" >
						<option value="{{$libro->idioma->id}}" select="selected" >Selecione un idioma</option>
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
<table width="95%" cellspacing="0" cellpadding="15">	
	<tr align="left">
		<th>Quitar como autor <span class="tooltip" title="Tilde las cajas para quitar uno o mas autores.">[?]</span></th>
		<th>Agregar como autor <span class="tooltip" title="Seleccione uno ó más autores de la lista para agregarlos como autores de este libro.">[?]</span></th>
		<th>Crear uno nuevo <span class="tooltip" title="Tilde 'Otro' para crear un autor que no se encuentra en la lista.">[?]</span></th>
	</tr>
	<tr valign="top">	
		<td>
			@foreach($libro->autores()->where('id','<>',1)->get() as $autor)
				<input type="checkbox" name="quitar-autor[]" value="{{$autor->id}}"> {{$autor->nombre}}<br/>
			@endforeach
		</td>
		<td>
			<p></p>
			<select name="agregar-autor[]" multiple>
			@foreach($autores as $autor)
				<option value="{{$autor->id}}">{{$autor->nombre}}</option>
			@endforeach
			</select>
			
		</td>
		<td>
			<input name="autor-checkbox" type="checkbox" title="Habilitar la creación de un nuevo autor" onchange="habilitarOtro(this,'autor-otro')" />Otro: 
			<input id="autor-otro" name="autor-otro" value="{{Input::old('autor-otro')}}"  disabled placeholder="Doña Petrona"/>
		</td>
	</tr>
</table>
	<input type="hidden" name="modificar" value="autores">	
	<input type="submit" value="Modificar" title="Realiza los cambios solicitados"/>
	<input type="reset" value="Limpiar" title="Borra los datos ingresados"/>
	<a href="/admin/libros/" style="text-decoration:none;"><input type="button" value="Cancelar" title="Cancela la operación"/></a>
</form>
<br/><br/>
<a name="etiquetas"></a>
<h3>Etiquetas</h3>
<form method="post" action="/admin/libros/{{$libro->id}}/modificar">
<table width="95%" cellspacing="0" cellpadding="15">	
	<tr align="left">
		<th>Quitar como etiqueta <span class="tooltip" title="Tilde las cajas para quitar una o más etiquetas.">[?]</span></th>
		<th>Agregar como etiqueta <span class="tooltip" title="Seleccione una ó más etiquetas de la lista para agregarlas como etiquetas de este libro.">[?]</span></th>
		<th>Crear uno nuevo <span class="tooltip" title="Tilde 'Otro' para crear una etiqueta que no se encuentra en la lista.">[?]</span></th>
	</tr>
	<tr valign="top">	
		<td>
			@foreach($libro->etiquetas()->where('id','<>',1)->get() as $etiqueta)
				<input type="checkbox" name="quitar-etiqueta[]" value="{{$etiqueta->id}}"> {{$etiqueta->nombre}}<br/>
			@endforeach
		</td>
		<td>
			<p></p>
			<select name="agregar-etiqueta[]" multiple>
			@foreach($etiquetas as $etiqueta)
				<option value="{{$etiqueta->id}}">{{$etiqueta->nombre}}</option>
			@endforeach
			</select>
			
		</td>
		<td>
			<input name="etiqueta-checkbox" type="checkbox" title="Habilitar la creación de un nuevo etiqueta" onchange="habilitarOtro(this,'etiqueta-otro')" />Otro: 
			<input id="etiqueta-otro" name="etiqueta-otro" value="{{Input::old('etiqueta-otro')}}"  disabled placeholder="tradicional"/>
		</td>
	</tr>
</table>
		<input type="hidden" name="modificar" value="etiquetas">
		
		<input type="submit" value="Modificar" title="Realiza los cambios solicitados"/>
		<input type="reset" value="Limpiar" title="Borra los datos ingresados"/>
		<a href="/admin/libros/" style="text-decoration:none;"><input type="button" value="Cancelar" title="Cancela la operación"/></a>
</form>
<br/><br/>
<a name="archivos"></a>
<h3>Tapa e índice</h3>
<p>Suba un archivo de imagen *.jpg ó *.png</p>
	<div style="float:left;width:250px;text-align:center;">
		<img src="/datos/tapas/{{$libro->tapa}}" alt="Tapa del libro" title="Tapa del libro" width="175" style="box-shadow:10px 8px 10px #ccc; border:1px solid #ccc" />
		<br/>
		<form action="/admin/libros/{{$libro->id}}/modificar" method="post" accept-charset="UTF-8" enctype="multipart/form-data">
			<input type="hidden" name="modificar" value="archivos">
			<input type="hidden" name="tipo" value="tapa">
			<br/><br/>
			<input type="file"  name="archivo" accept="image/*"/><br/>
			<input type="submit" value="Cambiar"/>
			
		</form>
	</div>
	<div style="float:right;width:800px;text-align:center;">
		<img src="/datos/indices/{{$libro->índice}}" alt="Índice del libro" title="Índice del libro" width="175" style="box-shadow:10px 8px 10px #ccc; border:1px solid #ccc" />
		<br/>
		<form action="/admin/libros/{{$libro->id}}/modificar" method="post" accept-charset="UTF-8" enctype="multipart/form-data">
			<input type="hidden" name="modificar" value="archivos">
			<input type="hidden" name="tipo" value="indice">
			<br/><br/>
			<input type="file"  name="archivo" accept="image/*"/><br/>
			<input type="submit" value="Cambiar"/>
			
		</form>
	</div>
	<br style="clear:both;"/><br/>

	<br/><br/>
	<a href="/admin/libros/" title="Retornar a la Gestión de Libros">Volver</a>
</div>	
<script src="/scripts/formularioLibro.js">Requiere tener activado JavaScript para el correcto funcionamiento del formulario!</script>
@stop
