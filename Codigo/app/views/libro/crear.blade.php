@extends('admin')

@section('menuActivo')
menuActivo='libros'
@stop

@section('contenido')

<h1>Gestión de Libros</h1>
<h2>Agregar un libro</h2>
@if(count($errors) > 0)
<div class="mensajeDeError">
	<p>Error al completar el formulario:</p>
	<ul>
		@foreach(($errors->all()) as $mensajeDeError)
		<li>{{$mensajeDeError}}</li>
		@endforeach
	</ul>
</div>
@endif
<p>Complete la totalidad de los siguientes campos:</p>
<form action="/admin/libros/crear" method="post" accept-charset="UTF-8" enctype="multipart/form-data">
	ISBN: <input name="isbn" value="{{Input::old('isbn')}}" placeholder="12345678910"/> <span class="tooltip" title="El ISBN es un número de 10 a 13 dígitos.">[?]</span><br/>
	Título: <input name="titulo" value="{{Input::old('titulo')}}" placeholder="Cocina Argentina"/> <span class="tooltip" title="El título debe contener sólo letras y números, y debe ser de longitud mayor a 2.">[?]</span><br/>
	Autor/es:<span class="tooltip" title="Seleccione uno o más autores presionando Ctrl y clickeando el botón izquierdo del mouse.">[?]</span> <select name="autor[]" multiple >				
				@foreach($autores as $autor)
				<option value="{{$autor->id}}">{{$autor->nombre}}</option>
				@endforeach
			</select> 
			<input name="autor-checkbox" type="checkbox" title="Habilitar la creación de un nuevo autor" onchange="habilitarOtro(this,'autor-otro')" />Otro: 
			<input id="autor-otro" name="autor-otro" value="{{Input::old('autor-otro')}}"  disabled placeholder="Doña Petrona"/><span class="tooltip" title="Tilde 'Otro' para crear un autor que no se encuentra en la lista.">[?]</span><br/><br/>

	Editorial:<span class="tooltip" title="Seleccione una editorial de la lista.">[?]</span> <select name="editorial[]">				
				@foreach($editoriales as $editorial)
					{{'<option value="'. $editorial->id .'">'. $editorial->nombre .'</option>'}}
				@endforeach			</select> 
			<input name="editorial-checkbox"  type="checkbox" title="Habilitar la creación de una nueva editorial" onchange="habilitarOtro(this,'editorial-otro')"/>Otra: 
			<input id="editorial-otro" name="editorial-otro" value="{{Input::old('editorial-otro')}}" placeholder="Sudamericana" /><span class="tooltip" title="Tilde 'Otro' para crear una editorial que no se encuentra en la lista.">[?]</span><br/><br/>
	Año de edición: <input size="4" name="anoDeEdicion" value="{{Input::old('anoDeEdicion')}}" placeholder="2014"/><span class="tooltip" title="Ingrese un número entre 1900 y 2014">[?]</span><br/><br/>
	Idioma:<span class="tooltip" title="Seleccione un idioma de la lista.">[?]</span> <select name="idioma">				
				@foreach($idiomas as $idioma)
					{{'<option value="'. $idioma->id .'">'. $idioma->nombre .'</option>'}}
				@endforeach
			</select> 
			<input name="idioma-checkbox" type="checkbox" title="Habilitar la creación de un nuevo idioma" onchange="habilitarOtro(this,'idioma-otro')"/>Otro: 
			<input id="idioma-otro" name="idioma-otro" value="{{Input::old('idioma-otro')}}"  disabled placeholder="Chino Mandarín"/><span class="tooltip" title="Tilde 'Otro' para crear un idioma que no se encuentra en la lista.">[?]</span><br/><br/>
    Etiqueta/as:<span class="tooltip" title="Seleccione una o más etiquetas presionando Ctrl y clickeando el botón izquierdo del mouse.">[?]</span> <select name="etiqueta[]" multiple >
	            @foreach($etiquetas as $etiqueta)
				  {{'<option value="'. $etiqueta->id .'">'. $etiqueta->nombre .'</option>'}}
				 @endforeach				
			</select> 
			<input name="etiqueta-checkbox" type="checkbox"  title="Habilitar la creación de una nueva etiqueta" onchange="habilitarOtro(this,'etiqueta-otro')" />Otro: 
			<input id="etiqueta-otro" name="etiqueta-otro" value="{{Input::old('etiqueta-otro')}}"  disabled placeholder="italiana"/><span class="tooltip" title="Tilde 'Otro' para crear una etiqueta que no se encuentra en la lista.">[?]</span><br/><br/>
	Precio: <input size="4" name="precio" value="{{Input::old('precio')}}" placeholder="10.00"/><span class="tooltip" title="El precio debe respetar el siguiente formato: 4 dígitos enteros y 2 dígitos decimales separados por punto. Por ejemplo: 22.99">[?]</span><br/>
	Cantidad de hojas: <input size="4" name="cantidadDeHojas" value="{{Input::old('cantidadDeHojas')}}" placeholder="100"/><span class="tooltip" title="La cantidad de hojas debe ser un número entero entre 10 y 9999.">[?]</span><br/>
	Tapa (*.jpg,*.png):<span class="tooltip" title="La imagen debe ser un archivo con extensión .jpg o .png">[?]</span> <input name="tapa" type="file"/><br/>
	Índice (*.jpg,*.png):<span class="tooltip" title="La imagen debe ser un archivo con extensión .jpg o .png">[?]</span> <input name="indice" type="file"/><br/>
	
	
	<br/><br/>
	<input type="submit" value="Crear" title="Agrega este libro al catalogo"/>
	
	
	<input type="reset" value="Limpiar" title="Borra los datos ingresados"/>
	
	
	<a href="/admin/libros/" style="text-decoration:none;"><input type="button" value="Cancelar" title="Cancela la operacion"/></a>
	
	
</form>

<script>
	//hab/deshab el campo «Otro»
	function habilitarOtro(objetoOrigen,nombreDelInput){
		cajaDeTexto=document.getElementById(nombreDelInput)		
		if(objetoOrigen.checked==true){
			cajaDeTexto.disabled=false;
			
		}
		else{
			cajaDeTexto.disabled=true;
		}
	}
</script>

@stop
