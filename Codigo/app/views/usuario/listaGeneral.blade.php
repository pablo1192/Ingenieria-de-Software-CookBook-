@extends('admin')

@section('menuActivo')
menuActivo='usuarios'
@stop

@section('contenido')
<a name="area"></a>
<h1>Gestión de usuarios:</h1>
@yield ('cuenta')
<table width="80%">
  <tr>
    <th>Nombre</th>
    <th>Email</th>
    <th>Bloqueado</th>
    <th>¿Activo?</th>
    <th>Operaciones</th>
  </tr>

@yield('listado')

@stop