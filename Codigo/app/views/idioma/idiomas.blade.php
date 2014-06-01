@extends('admin')

@section('contenido')
<h1>Gestión de Idiomas</h1>

<h2>Idiomas <span title="Cantidad de idiomas en el Sistema">({{count($idiomas)}})</span>:</h2>

<table width="375">
	<tr>
		<th width="100" align="left">Idioma</th>
		<th align="left">Operaciones</th>
	</tr>
	@foreach($idiomas as $idioma){{'
	<tr>
		<td>'.$idioma->nombre.'</th>
		<td>
			<a href="/admin/idiomas/'.$idioma->id.'/modificar" title="Modifique este idioma">Modificar</a> 
			<a href="/admin/idiomas/'.$idioma->id.'/borrar" title="Borre este idioma" onclick="return confirm(\'¿Ud está seguro que desea eliminar el idioma '.$idioma->nombre.'?\')">Eliminar</a>
		</td>
	</tr>
	'}}
	 @endforeach
</table>
<h2>Operaciones</h2>
<a href="/admin/idiomas/crear" title="Agregar un nuevo idioma al Sistema" class="button button-verde button-mediano">Agregar</a>

<br/><br/>
<a href="/admin/libros" title="Vuelve al panel de Administración">Volver</a> 

@stop
