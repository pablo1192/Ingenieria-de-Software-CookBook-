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
@if(count($libros)> 0)

<h1><font color="purple"><center>¡Bienvenido a nuestro catálogo!</center></font> </h1>
<center><h2>Disponemos de los siguientes libros para ofrecerle:</h2></center>
@if (! Auth::check())

  </br><b><center><a href="/login" title="Iniciar sesión"><u>Inicie sesión</u></a> para acceder a los detalles de cada libro</b></center>
@endif
<br></br>
	
	@if((count($libros)/4) > 1)
		@for($i = 0; $i<(count($libros)/4)-1; $i++)
			   @for($j = 0; $j<4; $j++)
				  <div class="column{{$j+1}}">
					   <div class="box">
							<h3>{{$libros[($i*4)+$j]->título}}</h3>
							<table class="libro">
							<tr>
								<td rowspan="1">
									<img src="/datos/tapas/{{$libros[($i*4)+$j]->tapa}}" alt="Tapa del libro" title="Tapa del libro" class="imagenMiniatura" />
								</td>
								<td>
									<span class="dato"><strong>{{((count($libros[($i*4)+$j]->autores)>1)? 'Autores':'Autor')}}:</strong> {{implode(', ',array_pluck($libros[($i*4)+$j]->autores,'nombre'))}}</span><br/><br/>
									<span class="dato"><strong>Editorial:</strong> {{$libros[($i*4)+$j]->editorial->nombre}}</span>
								</td>
							</tr>
							<tr>
								<td colspan="2">					
									<span class="precio"><strong>Precio:</strong> $ {{$libros[($i*4)+$j]->precio}}</span>
								</td>
							</tr>
							</table>
							@if ($libros[($i*4)+$j]->agotado != 0)
								<strong><font size=4px color="red">Agotado</font></strong>  <br></br>
							@endif
							@if (! Auth::guest())
								<a href="/{{$libros[($i*4)+$j]->id}}/detalles" title="Conozca los detalles de este libro" class="button button-mediano"  >Ver mas</a><br><br/>
							@endif
						</div>
					</div>
			  @endfor
			  <br class="separador" /><br></br>
		@endfor
	@endif
	<!--Se procesan los restantes -->
	  @for($i=0;$i<count($libros)%4;$i++)
			   <div class="column{{$i+1}}">
				   <div class="box">
							<h3>{{$libros[$i+(floor(count($libros)/4)*4)]->título}}</h3>
							<table class="libro">
							<tr>
								<td rowspan="1">
									<img src="/datos/tapas/{{$libros[$i+(floor(count($libros)/4)*4)]->tapa}}" alt="Tapa del libro" title="Tapa del libro" class="imagenMiniatura" />
								</td>
								<td>
									<span class="dato"><strong>{{((count($libros[$i+(floor(count($libros)/4)*4)]->autores)>1)? 'Autores':'Autor')}}:</strong> {{implode(', ',array_pluck($libros[$i+(floor(count($libros)/4)*4)]->autores,'nombre'))}}</span><br/><br/>
									<span class="dato"><strong>Editorial:</strong> {{$libros[$i+(floor(count($libros)/4)*4)]->editorial->nombre}}</span>
								</td>
							</tr>
							<tr>
								<td colspan="2">					
									<span class="precio"><strong>Precio:</strong> $ {{$libros[$i+(floor(count($libros)/4)*4)]->precio}}</span>
								</td>
							</tr>
							</table>
							@if ($libros[$i+(floor(count($libros)/4)*4)]->agotado != 0)
								<strong><font size=4px color="red">Agotado</font></strong>  <br></br>
							@endif
							@if (! Auth::guest())
								<a href="/{{$libros[$i+(floor(count($libros)/4)*4)]->id}}/detalles" title="Conozca los detalles de este libro" class="button button-mediano"  >Ver mas</a><br><br/>
							@endif
					</div>
				</div>
				
	  @endfor
	  <br class="separador" /><br></br>


@else
     <h1><font color="purple">En este momento, no disponemos de libros para ofrecerle. Disculpe las molestias.</font></h1>
@endif   
@stop
