@extends('template')

@section('menuActivo')
menuActivo='catalogo'
@stop

@section('contenido')

@if ($alert = Session::get('ingreso-exitoso'))
    <center><div class="alert alert-warning">
        <strong>{{ $alert }}</strong>
    </div></center>
@endif

@if ($alert = Session::get('mensaje-registro'))
    <center><div class="alert alert-warning">
        <strong>{{ $alert }}</strong>
    </div></center>
@endif

<a name="area"></a>
<h1>Bienvenido a nuestro catálogo </h1>
<h2>En nuestro catálogo tenemos <span title="Cantidad de libros en el Sistema">({{count($libros)}})</span> libros para ofrecerle</h2>
@if (! Auth::check())

  </br><b><center><a href="/login" title="Iniciar sesión">Inicie sesión</a> para poder acceder a los detalles de cada libro</b></center>
@endif
<br></br>
@foreach($libros as $libro)
		
		<div style="float:left;width:250px;eight:100px;text-align:center;">
		  <img src="/datos/tapas/{{$libro->tapa}}" alt="Tapa del libro" title="Tapa del libro" width="100" style="float:left ;box-shadow:10px 8px 10px #ccc; border:1px solid #ccc" />
	    
		&nbsp;&nbsp;Título:&nbsp; {{$libro->título}}<br><br/>
		&nbsp;&nbsp;Autor/es:&nbsp;{{implode(', ',array_pluck($libro->autores,'nombre'))}}<br><br/>
		&nbsp;&nbsp;Editorial:&nbsp;{{$libro->editorial->nombre}}<br><br/>
		&nbsp;&nbsp;Precio: $ {{$libro->precio}}<br><br/>
		@if ($libro->agotado != 0)
		   <b><u><font color="red"> Agotado en este momento </font></u></b>  <br></br>
		@endif
		@if (! Auth::guest())
		<a href="/{{$libro->id}}/detalles" title="Vea los detalles, sólo si inicio sesión" class="button button-mediano" style="float:center" >Ver más</a><br><br/> 
		@endif
		</div>
@endforeach<!--

$i=1 
@for ($i = 1; $i < count($libros)/4; $i++)
  
  @for
  <li>{{ $i }} ... </li>
@endfor
-->

@stop