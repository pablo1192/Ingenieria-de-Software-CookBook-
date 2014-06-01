@extends('admin')

@section('contenido')
<h1>Gestión de usuarios:</h1>
<h2>Usuarios <span title="Usuarios en el Sistema">({{count($usuarios)}})</span>:</h2>
<table width="80%">
  <tr>
    <th>Nombre</th>
    <th>Apellido</th>
    <th>Email</th>
    <th>DNI</th>
    <th>Bloqueado</th>
    <th>¿Activo?</th>
    <th>Operaciones</th>
  </tr>
@foreach($usuarios as $usuario)
{{
  '<tr align="center">
    <td>'.$usuario->nombre.'</td>
    <td>'.$usuario->apellido.'</td>
    <td>'.$usuario->email.'</td>
    <td>'.$usuario->dni.'</td>
    <td>'.($usuario->bloqueado?'Sí':'No').'</td>
    <td>'.($usuario->dadoDeBaja?'No':'Sí').'</td>    
    <td><a href="/admin/usuarios/'. $usuario->id. '/modificar" title="Modificar los datos del usuario">Modificar</a> 
    <a href="/admin/usuarios/'. $usuario->id. '/bloquear" title="Bloquear al usuario" onclick="return confirm(\'¿Seguro que desea bloquear al usuario?\')">'.(($usuario->bloqueado)?'Desbloquear':'Bloquear').'</a>
    </td>
  </tr>'
  
}}
@endforeach
  
</table>  

<h2>Función de testeo</h2>
<a href="/admin/usuarios/nuevo" title="Agregar un nuevo usuario">Agregar usuario</a> 

@stop
