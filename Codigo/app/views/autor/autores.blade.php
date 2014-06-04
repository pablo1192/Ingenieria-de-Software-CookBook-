@extends('admin')

@section('menuActivo')
menuActivo='libros'
@stop

@section('contenido')
<h1>Gestión de Autores</h1>

<h2>Autores <span title="Cantidad de autores en el Sistema">({{count($autores)}})</span>:</h2>

<table width="50%" >
	<tr>
		<th width="200" align="left">Autor</th>
		<th align="left">Operaciones</th>
	</tr>
	@foreach($autores as $autor){{'
	<tr>
		<td>'.$autor->nombre.'</th>
		<td>
			<a href="/admin/autores/'.$autor->id.'/modificar" title="Modifique este autor">Modificar</a> 
			<a href="/admin/autores/'.$autor->id.'/borrar" title="Borre este autor" onclick="return confirm(\'¿Ud está seguro que desea eliminar el autor '.$autor->nombre.'?\')">Eliminar</a>
		</td>
	</tr>
	'}}
	 @endforeach
</table>
<h2>Operaciones</h2>
<a href="/admin/autores/crear" title="Agregar un nuevo autor al Sistema" class="button button-verde button-mediano">Agregar</a>

<br/><br/>
<a href="/admin/libros" title="Vuelve al panel de Administración">Volver</a> 

@stop