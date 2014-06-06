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

<h1><font color="purple">Bienvenido a nuestro catálogo </font> </h1>
<h2>En nuestro catálogo tenemos los siguientes libros para ofrecerle</h2>
@if (! Auth::check())

  </br><b><center><a href="/login" title="Iniciar sesión">Inicie sesión</a> para poder acceder a los detalles de cada libro</b></center>
@endif
<br></br>

      @for($i = 0; $i<(count($libros)/4)-1; $i++)
       @for($j = 0; $j<4; $j++)  
          <div class="column{{$j+1}}">
               <div class="box"> 	
                   			   
                    <h3>{{$libros[($i*4)+$j]->título}} <!--({{$i}} : {{$j}} )--></h3>
                    <img src="/datos/tapas/{{$libros[($i*4)+$j]->tapa}}" alt="Tapa del libro" title="Tapa del libro" width="100" style="float:left ;box-shadow:10px 8px 10px #ccc; border:1px solid #ccc" />
                    &nbsp;&nbsp;Autor/es:&nbsp;{{implode(', ',array_pluck($libros[($i*4)+$j]->autores,'nombre'))}}<br><br/>
                    &nbsp;&nbsp;Editorial:&nbsp;{{$libros[($i*4)+$j]->editorial->nombre}}<br><br/>
                    &nbsp;&nbsp;Precio: $ {{$libros[($i*4)+$j]->precio}}<br><br/>
                    @if ($libros[($i*4)+$j]->agotado != 0)
                       <b><u><font color="purple"> Agotado en este momento </font></u></b>  <br></br>
                    @endif
                    @if (! Auth::guest())
                    <a href="/{{$libros[($i*4)+$j]->id}}/detalles" title="Vea los detalles, solo si inicio sesión" class="button button-mediano" style="float:center" >Ver mas</a><br><br/> 
                    @endif
                </div>
            </div>
       @endfor
      <br class="separador" /><br></br>
      @endfor
      @if(count($libros)%4 != 0)<!--Quedan libros -->
         @for($i=0;$i<count($libros)%4;$i++)  
           <div class="column{{$i+1}}">
               <div class="box"> 	
               		<!--<b><u><font color="red"> Agotado en este momento </font></u></b>	 -->  
                    <h3>{{$libros[$i+(floor(count($libros)/4)*4)]->título}} </h3>
                    <img src="/datos/tapas/{{$libros[$i+(floor(count($libros)/4)*4)]->tapa}}" alt="Tapa del libro" title="Tapa del libro" width="100" style="float:left ;box-shadow:10px 8px 10px #ccc; border:1px solid #ccc" />
                    &nbsp;&nbsp;Autor/es:&nbsp;{{implode(', ',array_pluck($libros[$i+(floor(count($libros)/4)*4)]->autores,'nombre'))}}<br><br/>
                    &nbsp;&nbsp;Editorial:&nbsp;{{$libros[$i+(floor(count($libros)/4)*4)]->editorial->nombre}}<br><br/>
                    &nbsp;&nbsp;Precio: $ {{$libros[$i+(floor(count($libros)/4)*4)]->precio}}<br><br/>
                    @if ($libros[$i+(floor(count($libros)/4)*4)]->agotado != 0)
                       <b><u><font color="cookbook"> Agotado en este momento </font></u></b>  <br></br>
                    @endif
                    @if (! Auth::guest())
                    <a href="/{{$libros[$i+(floor(count($libros)/4)*4)]->id}}/detalles" title="Vea los detalles, solo si inicio sesión" class="button button-mediano" style="float:center" >Ver mas</a><br><br/> 
                    @endif
                </div>
            </div>            
         @endfor
        <br class="separador" /><br></br>
	  @else
          @for($i=(count($libros)-4);$i<count($libros);$i++)  
           <div class="column{{$i+1}}">
               <div class="box"> 	
               		<!--<b><u><font color="red"> Agotado en este momento </font></u></b>	 -->  
                    <h3>{{$libros[$i]->título}} </h3>
                    <img src="/datos/tapas/{{$libros[$i]->tapa}}" alt="Tapa del libro" title="Tapa del libro" width="100" style="float:left ;box-shadow:10px 8px 10px #ccc; border:1px solid #ccc" />
                    &nbsp;&nbsp;Autor/es:&nbsp;{{implode(', ',array_pluck($libros[$i]->autores,'nombre'))}}<br><br/>
                    &nbsp;&nbsp;Editorial:&nbsp;{{$libros[$i]->editorial->nombre}}<br><br/>
                    &nbsp;&nbsp;Precio: $ {{$libros[$i]->precio}}<br><br/>
                    @if ($libros[$i]->agotado != 0)
                       <b><u><font color="cookbook"> Agotado en este momento </font></u></b>  <br></br>
                    @endif
                    @if (! Auth::guest())
                    <a href="/{{$libros[$i]->id}}/detalles" title="Vea los detalles, solo si inicio sesión" class="button button-mediano" style="float:center" >Ver mas</a><br><br/> 
                    @endif
                </div>
            </div>            
         @endfor
       <br class="separador" /><br></br>  
      @endif  
@else
     <h1><font color="purple">En este momento no tenemos libros para mostrar, sepa disculparnos. </font> </h1>
@endif	 
@stop