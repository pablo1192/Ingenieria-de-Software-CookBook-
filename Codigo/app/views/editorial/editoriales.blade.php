@extends('admin')

@section('ayuda')
    <a href="javascript: void(0)" onclick="popup('/admin/ayuda#libros')"><img width="24" src="/template/images/ayuda.png" alt="Ayuda"/></a>
@overwrite

@section('menuActivo')
menuActivo='libros'
@stop

@section('contenido')
<h1>Gestión de Editoriales</h1>

<h2>Editoriales <span title="Cantidad de editoriales en el Sistema">({{count($editoriales)}})</span>:</h2>

<table width="375">
	<tr>
		<th width="100" align="left">Editorial</th>
		<th align="left">Operaciones</th>
	</tr>
	@foreach($editoriales as $editorial){{'
	<tr>
		<td>'.$editorial->nombre.'</th>
		<td>
			<a href="/admin/editoriales/'.$editorial->id.'/modificar" title="Modifique esta editorial">Modificar</a> 
			<a href="/admin/editoriales/'.$editorial->id.'/borrar" title="Borre esta editorial" onclick="return confirm(\'¿Ud está seguro que desea eliminar la editorial '.$editorial->nombre.'?\')">Eliminar</a>
		</td>
	</tr>
	'}}
	 @endforeach
</table>
<h2>Operaciones</h2>
<a href="/admin/editoriales/crear" title="Agregar una nueva editorial al Sistema" class="button button-verde button-mediano">Agregar</a>

<br/><br/>
<a href="/admin/libros" title="Vuelve al panel de Administración">Volver</a> 

@stop
