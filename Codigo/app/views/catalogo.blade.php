@extends('template')

@section('menuActivo')
menuActivo='catalogo'
@stop

@section('contenido')

<a name="area"></a>

<h2></h2>
<!-- Formularios de busqueda: no combinables. Autor, titulo, isbn, editorial(cerrada), etiqueta(cerrada) -->
<table width="100%" style="margin-bottom:8px;">
<tr>
	<td width="40%">
		<form method="GET" action="/">			
			<select name="filtrar" style="padding:2px;width:80px;display:inline;">
				<option value="titulo">Título</option>
				<option value="isbn">ISBN</option>
				<option value="autor">Autor</option>
			</select>
			<input name="valor" size="25" value="" placeholder="Ingrese su búsqueda..." />
			<input value="Buscar" type="submit" />
		</form>
	</td>
	<td >
		<form method="GET" action="/">
			<input type="hidden" name="filtrar" value="editorial"/>
			<select name="valor" style="padding:2px;width:180px;" onchange="this.form.submit()">
				<option value=""  selected="selected">Filtrar por Editorial</option>
				@foreach(Editorial::disponibles()->get() as $editorial)
					<option value="{{$editorial->id}}">{{$editorial->nombre}}</option>
				@endforeach
				
			</select>
		</form>
	</td>
	<td >
		<form method="GET" action="/">
			<input type="hidden" name="filtrar" value="etiqueta"/>
			<select name="valor" style="padding:2px;width:180px;" onchange="this.form.submit()">
				<option value=""  selected="selected">Filtrar por Etiqueta</option>
				@foreach(Etiqueta::disponibles()->get() as $etiqueta)
					<option value="{{$etiqueta->id}}">{{$etiqueta->nombre}}</option>
				@endforeach
				
			</select>
		</form>
	</td>
	<td>
		@if($filtrado)
			Estás filtrando por <a class="cookbook" href="/#area" title="Restablece el catálogo">{{$criterio}}</a> 
		@endif
	</td>
</tr>
</table>


@if( ($filtrado) && (count($libros)==0))
	<div class="mensaje mensaje-notificacion">
		No existen libros que concuerden con su búsqueda. <a href="/#area">Haga click aquí para volver a intentarlo.</a>
	</div>

@elseif(count($libros)> 0)

	
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
