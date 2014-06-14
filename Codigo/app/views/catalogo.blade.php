@extends('template')

@section('menuActivo')
menuActivo='catalogo'
@stop

@section('contenido')

<a name="area"></a>
@if(count($libros)> 0)

<h2></h2>
</br>
	
	@if((count($libros)/4) >= 1)
		@for($i = 0; $i<=(count($libros)/4)-1; $i++)
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
									<span class="dato"><strong>Editorial:</strong> {{$libros[($i*4)+$j]->editorial->nombre}}</span><br/><br/>
									@if ($libros[($i*4)+$j]->agotado != 0)
										<span class="agotado"><strong>Agotado</strong></span>
									@endif
								</td>
							</tr>
							<tr>
								<td colspan="2">					
									<span class="precio"><strong>Precio:</strong> $ {{$libros[($i*4)+$j]->precio}}</span>
								</td>
							</tr>
							</table>							
								<a href="/{{$libros[($i*4)+$j]->id}}/detalles" title="Conozca los detalles de este libro" class="button button-mediano">Ver detalles</a><br><br/>
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
									<span class="dato"><strong>Editorial:</strong> {{$libros[$i+(floor(count($libros)/4)*4)]->editorial->nombre}}</span><br/><br/>
									@if ($libros[$i+(floor(count($libros)/4)*4)]->agotado != 0)
										<span class="agotado"><strong>Agotado</strong></span>
									@endif
								</td>
							</tr>
							<tr>
								<td colspan="2">					
									<span class="precio"><strong>Precio:</strong> $ {{$libros[$i+(floor(count($libros)/4)*4)]->precio}}</span>
								</td>
							</tr>
							</table>							
								<a href="/{{$libros[$i+(floor(count($libros)/4)*4)]->id}}/detalles" title="Conozca los detalles de este libro" class="button button-mediano">Ver detalles</a><br><br/>
					</div>
				</div>	
	  @endfor
	  <br class="separador" />

@else
     <h1><font color="purple">En este momento, no disponemos de libros para ofrecerle. Disculpe las molestias.</font></h1>
@endif   
@stop
