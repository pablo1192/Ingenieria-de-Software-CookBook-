@extends('admin')

@section('menuActivo')
menuActivo='libros'
@stop

@section('contenido')
<a name="area"></a>
<h1>Gestión de libros:</h1>
<h2>Libros <span title="Cantidad de libros en el Sistema">({{count($libros)}})</span>:</h2>
<table width="90%">
	<tr>
		<th>ISBN</th>
		<th>Título</th>
		<th>Autor</th>
		<th>Editorial</th>
		<th>Precio</th>
		<th>Disponible</th>
		<th>Operaciones</th>
	</tr>
@foreach($libros as $libro)
	<tr align = "center">
		<td>{{$libro->isbn}}</td>
		<td><a href="/admin/libros/{{$libro->id}}" title="Ver detalles de este libro">{{$libro->título}}</a></td>
		<td>{{implode(', ',array_pluck($libro->autores,'nombre'))}}</td>
		<td>{{$libro->editorial->nombre}}</td>
		<td>${{$libro->precio}}</td>
		<td>{{$libro->agotado?'No':'Sí'}}</td>				
		<td><a href="/admin/libros/{{$libro->id}}/modificar" title="Modificar este libro">Modificar</a> 
			<a href="/admin/libros/{{$libro->id}}/agotado" title="Marcar como {{(($libro->agotado)?'disponible':'agotado')}}" onclick="return confirm('¿Ud está seguro que desea marcar como {{(($libro->agotado)?'disponible':'agotado')}} el libro \n«{{ $libro->título }}» ?')">{{(($libro->agotado)?'Disponible':'Agotado')}}</a>
			<a href="/admin/libros/{{$libro->id}}/borrar" title="Borrar este libro" onclick="return confirm('¿Ud está seguro que desea eliminar el libro \n«{{$libro->título}}» ?')">Eliminar</a>
		</td>
	</tr>

@endforeach
	
</table>	


<h2>Operaciones</h2>
<a href="/admin/libros/crear" title="Agregue un nuevo libro al catálogo" class="button button-verde button-mediano">Agregar</a> 



<h2>Otros</h2>
<p>Operaciones relacionadas con la gestión de los libros:</p>
<a href="/admin/autores/" title="Gestione los autores" class="button button-mediano">Autores</a> 
<a href="/admin/etiquetas/" title="Gestione las etiquetas" class="button button-mediano">Etiquetas</a> 
<a href="/admin/editoriales/" title="Gestione las editoriales" class="button button-mediano">Editoriales</a> 
<a href="/admin/idiomas/" title="Gestione los idiomas" class="button button-mediano">Idiomas</a> 

<br/><br/>
<a href="/admin/" title="Vuelve al panel de Administración">Volver</a> 

@stop
