@extends('admin')

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
	ISBN: <input name="isbn" value="{{Input::old('isbn')}}" placeholder="123456789"/><br/>
	Título: <input name="titulo" value="{{Input::old('titulo')}}" placeholder="Cocina Argentina"/><br/>
	Autor/es: <select name="autor[]" multiple >				
				@foreach($autores as $autor)
				<option value="{{$autor->id}}">{{$autor->nombre}}</option>
				@endforeach
			</select> 
			<input name="autor-checkbox" type="checkbox" title="Habilitar la creación de un nuevo autor" onchange="habilitarOtro(this,'autor-otro')" />Otro: 
			<input id="autor-otro" name="autor-otro" value="{{Input::old('autor-otro')}}"  disabled placeholder="Doña Petrona"/><br/><br/>

	Editorial: <select name="editorial[]">				
				@foreach($editoriales as $editorial)
					{{'<option value="'. $editorial->id .'">'. $editorial->nombre .'</option>'}}
				@endforeach			</select> 
			<input name="editorial-checkbox"  type="checkbox" title="Habilitar la creación de una nueva editorial" onchange="habilitarOtro(this,'editorial-otro')"/>Otra: 
			<input id="editorial-otro" name="editorial-otro" value="{{Input::old('editorial-otro')}}" placeholder="Sudamericana" /><br/><br/>
	Año de edición: <input size="4" name="anoDeEdicion" value="{{Input::old('anoDeEdicion')}}" placeholder="2014"/><br/><br/>
	Idioma: <select name="idioma">				
				@foreach($idiomas as $idioma)
					{{'<option value="'. $idioma->id .'">'. $idioma->nombre .'</option>'}}
				@endforeach
			</select> 
			<input name="idioma-checkbox" type="checkbox" title="Habilitar la creación de un nuevo idioma" onchange="habilitarOtro(this,'idioma-otro')"/>Otro: 
			<input id="idioma-otro" name="idioma-otro" value="{{Input::old('idioma-otro')}}"  disabled placeholder="Chino Mandarín"/><br/><br/>
    Etiqueta/as: <select name="etiqueta[]" multiple >
	            @foreach($etiquetas as $etiqueta)
				  {{'<option value="'. $etiqueta->id .'">'. $etiqueta->nombre .'</option>'}}
				 @endforeach				
			</select> 
			<input name="etiqueta-checkbox" type="checkbox"  title="Habilitar la creación de una nueva etiqueta" onchange="habilitarOtro(this,'etiqueta-otro')" />Otro: 
			<input id="etiqueta-otro" name="etiqueta-otro" value="{{Input::old('etiqueta-otro')}}"  disabled placeholder="italiana"/><br/><br/>
	Precio: <input size="4" name="precio" value="{{Input::old('precio')}}" placeholder="10.00"/><br/>
	Cantidad de hojas: <input size="4" name="cantidadDeHojas" value="{{Input::old('cantidadDeHojas')}}" placeholder="100"/><br/>
	Tapa (*.jpg,*.png): <input name="tapa" type="file"/><br/>
	Índice (*.jpg,*.png): <input name="indice" type="file"/><br/>
	
	
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
