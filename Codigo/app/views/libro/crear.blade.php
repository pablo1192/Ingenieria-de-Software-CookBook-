@extends('admin')

@section('contenido')

<h1>Agregar un libro</h1>
<p>Complete la totalidad de los siguientes campos:</p>
<form action="/admin/libros/crear/" method="post">
	ISBN: <input name="isbn" value="" placeholder="123456789"/><br/>
	Título: <input name="titulo" value="" placeholder="Cocina Argentina"/><br/>
	Autor/es: <select name="autor" multiple >				
				<option value="...">...</option>
				
			</select> 
			<input type="checkbox" title="Habilitar la creación de un nuevo autor" onchange="habilitarOtro(this,'autor-otro')" checked=false/>Otro: 
			<input id="autor-otro"name="autor-otro" value=""  disabled placeholder="Doña Petrona"/><br/>

	Editorial: <select name="editorial">				
				@foreach($editoriales as $editorial)
					{{'<option value="'. $editorial->id .'">'. $editorial->nombre .'</option>'}}
				@endforeach			</select> 
			<input value="" type="checkbox" title="Habilitar la creación de una nueva editorial" onchange="habilitarOtro(this,'editorial-otro')"/>Otra: 
			<input id="editorial-otro" name="editorial-otro" value="" placeholder="Sudamericana"  disabled/><br/>
	Año de edición: <input size="4" name="anoDeEdicion" value="" placeholder="2014"/><br/>
	Idioma: <select name="idioma">				
				@foreach($idiomas as $idioma)
					{{'<option value="'. $idioma->id .'">'. $idioma->nombre .'</option>'}}
				@endforeach
			</select> 
			<input value="" type="checkbox" title="Habilitar la creación de un nuevo idioma" onchange="habilitarOtro(this,'idioma-otro')"/>Otro: 
			<input id="idioma-otro" name="idioma-otro" value=""  disabled placeholder="Chino Mandarín"/><br/>
    Etiqueta/as: <select name="etiqueta" multiple >
	            @foreach($etiquetas as $etiqueta)
				  {{'<option value="'. $etiqueta->id .'">'. $etiqueta->nombre .'</option>'}}
				 @endforeach				
			</select> 
			<input type="checkbox" title="Habilitar la creación de una nueva etiqueta" onchange="habilitarOtro(this,'etiqueta-otro')" checked=false/>Otro: 
			<input id="etiqueta-otro"name="etiqueta-otro" value=""  disabled placeholder="Comidas italianas"/><br/>			
	Precio: <input size="4" name="precio" value="" placeholder="10.00"/><br/>
	Cantidad de hojas: <input size="4" name="cantidadDeHojas" value="" placeholder="100"/><br/>
	Tapa (*.jpg): <input name="tapa" type="file"/><br/>
	Índice (*.jpg): <input name="tapa" type="file"/><br/>
	
	
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
</script	
@stop
