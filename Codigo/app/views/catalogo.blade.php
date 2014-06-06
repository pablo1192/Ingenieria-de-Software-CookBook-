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

      @for($i = 0; $i<(count($libros)/4)-1; $i++)
       @for($j = 0; $j<4; $j++)  
          <div class="column{{$j+1}}">
               <div class="box">  
                           
                    <h3>{{$libros[($i*4)+$j]->título}} <!--({{$i}} : {{$j}} )--></h3>
                    <img src="/datos/tapas/{{$libros[($i*4)+$j]->tapa}}" alt="Tapa del libro" title="Tapa del libro" width="100" style="float:left ;box-shadow:10px 8px 10px #ccc; border:1px solid #ccc" />
                    &nbsp;&nbsp;@if(count($libros[$i]->autores)>1)
                                  Autores:
                                  @else
                                  Autor:
                                  @endif
                                  {{implode(', ',array_pluck($libros[($i*4)+$j]->autores,'nombre'))}}<br><br/>
                    &nbsp;&nbsp;Editorial:&nbsp;{{$libros[($i*4)+$j]->editorial->nombre}}<br><br/>
                    &nbsp;&nbsp;Precio: ${{$libros[($i*4)+$j]->precio}}<br><br/>
                    @if ($libros[($i*4)+$j]->agotado != 0)
                       <strong><font size=4px color="red">Agotado</font></strong>  <br></br>
                    @endif
                    @if (! Auth::guest())
                    <a href="/{{$libros[($i*4)+$j]->id}}/detalles" title="Vea los detalles, solo si inicio sesión" class="button button-mediano" style="float:center">Ver detalles</a><br><br/> 
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
                  <!--<b><u><font color="red"> Agotado en este momento </font></u></b>   -->  
                    <h3>{{$libros[$i+(floor(count($libros)/4)*4)]->título}} </h3>
                    <img src="/datos/tapas/{{$libros[$i+(floor(count($libros)/4)*4)]->tapa}}" alt="Tapa del libro" title="Tapa del libro" width="100" style="float:left ;box-shadow:10px 8px 10px #ccc; border:1px solid #ccc" />
                    &nbsp;&nbsp;@if(count($libros[$i]->autores)>1)
                                  Autores:
                                  @else
                                  Autor:
                                  @endif
                                  {{implode(', ',array_pluck($libros[$i+(floor(count($libros)/4)*4)]->autores,'nombre'))}}<br><br/>
                    &nbsp;&nbsp;Editorial:&nbsp;{{$libros[$i+(floor(count($libros)/4)*4)]->editorial->nombre}}<br><br/>
                    &nbsp;&nbsp;Precio: ${{$libros[$i+(floor(count($libros)/4)*4)]->precio}}<br><br/>
                    @if ($libros[$i+(floor(count($libros)/4)*4)]->agotado != 0)
                       <strong><font size=4px color="red">Agotado</font></strong>  <br></br>
                    @endif
                    @if (! Auth::guest())
                    <a href="/{{$libros[$i+(floor(count($libros)/4)*4)]->id}}/detalles" title="Vea los detalles, solo si inicio sesión" class="button button-mediano" style="float:center">Ver detalles</a><br><br/> 
                    @endif
                </div>
            </div>            
         @endfor
        <br class="separador" /><br></br>
    @else
          @for($i=(count($libros)-4);$i<count($libros)-1;$i++)  
           <div class="column{{3}}">
               <div class="box">  
                  <!--<b><u><font color="red"> Agotado en este momento </font></u></b>   -->  
                    <h3>{{$libros[$i]->título}} </h3>
                    <img src="/datos/tapas/{{$libros[$i]->tapa}}" alt="Tapa del libro" title="Tapa del libro" width="100" style="float:left ;box-shadow:10px 8px 10px #ccc; border:1px solid #ccc" />
                    &nbsp;&nbsp;@if(count($libros[$i]->autores)>1)
                                  Autores:
                                  @else
                                  Autor:
                                  @endif
                                  {{implode(', ',array_pluck($libros[$i]->autores,'nombre'))}}<br><br/>
                    &nbsp;&nbsp;Editorial:&nbsp;{{$libros[$i]->editorial->nombre}}<br><br/>
                    &nbsp;&nbsp;Precio: ${{$libros[$i]->precio}}<br><br/>
                    @if ($libros[$i]->agotado != 0)
                       <strong><font size=4px color="red">Agotado</font></strong>  <br></br>
                    @endif
                    @if (! Auth::guest())
                    <a href="/{{$libros[$i]->id}}/detalles" title="Vea los detalles, solo si inicio sesión" class="button button-mediano" style="float:center">Ver detalles</a><br><br/> 
                    @endif
                </div>
            </div>            
         @endfor
         @if($i = count($libros)-1)
                  <div class="box">  
                  <!--<b><u><font color="red"> Agotado en este momento </font></u></b>   -->  
                    <h3>{{$libros[$i]->título}} </h3>
                    <img src="/datos/tapas/{{$libros[$i]->tapa}}" alt="Tapa del libro" title="Tapa del libro" width="100" style="float:left ;box-shadow:10px 8px 10px #ccc; border:1px solid #ccc" />
                    &nbsp;&nbsp; @if(count($libros[$i]->autores)>1)
                                  Autores:
                                  @else
                                  Autor:
                                  @endif
                                  {{implode(', ',array_pluck($libros[$i]->autores,'nombre'))}}<br><br/>
                    &nbsp;&nbsp;Editorial:&nbsp;{{$libros[$i]->editorial->nombre}}<br><br/>
                    &nbsp;&nbsp;Precio: ${{$libros[$i]->precio}}<br><br/>
                    @if ($libros[$i]->agotado != 0)
                       <strong><font size=4px color="red">Agotado</font></strong>   <br></br>
                    @endif
                    @if (! Auth::guest())
                    <a href="/{{$libros[$i]->id}}/detalles" title="Vea los detalles, solo si inicio sesión" class="button button-mediano" style="float:center">Ver detalles</a><br><br/> 
                    @endif
                </div>
          @endif
       <br class="separador" /><br></br>  
      @endif  
@else
     <h1><font color="purple">En este momento, no disponemos de libros para ofrecerle. Disculpe las molestias.</font></h1>
@endif   
@stop