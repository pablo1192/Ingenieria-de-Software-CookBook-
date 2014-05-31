@extends('admin')

@section('contenido')
<h1>Gestion de libros:</h1>
<h2>Libros <span title="Cantidad de libros en el Sistema">({{count($libros)}})</span>:</h2>
<table width="80%">
	<tr>
		<th>ISBN</th>
		<th>Titulo</th>
		<th>Autor</th>
		<th>Editorial</th>
		<th>Precio</th>
		<th>Disponible</th>
		<th>Operaciones</th>
	</tr>
@foreach($libros as $libro )
{{
	'<tr>
		<td>'.$libro->isbn.'</td>
		<td><a href="/admin/libros/'. $libro->id. '" title="Ver detalles de este libro">'.$libro->título.'</a></td>
		<td>¿?</td>
		<td>'.$libro->editorial->nombre.'</td>
		<td>$'.$libro->precio.'</td>
		<td>'.($libro->agotado?'No':'Si').'</td>				
		<td><a href="/admin/libros/'. $libro->id. '/modificar" title="Modificar este libro">Modificar</a> 
			<a href="/admin/libros/'. $libro->id. '/agotado" title="Marcar como '.(($libro->agotado)?'disponible':'agotado').'" onclick="return confirm(\'¿Ud está seguro que desea marcar como '.(($libro->agotado)?'disponible':'agotado').' el libro \n«'. $libro->título .'» ?\')">'.(($libro->agotado)?'Disponible':'Agotado').'</a>
			<a href="/admin/libros/'. $libro->id. '/borrar" title="Borrar este libro" onclick="return confirm(\'¿Ud está seguro que desea eliminar el libro \n«'. $libro->título .'» ?\')">Eliminar</a>
		</td>
	</tr>'
	
}}
@endforeach
	
</table>	


<h2>Operaciones</h2>
<a href="/admin/libros/crear" title="Agregue un nuevo libro al catálogo">Agregar</a> 
<a href="/admin/" title="Vuelve al panel de Administración">Volver</a> 

@stop
