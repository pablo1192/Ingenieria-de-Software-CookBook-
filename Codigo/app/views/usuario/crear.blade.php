@extends('admin')

@section('menuActivo')
menuActivo='usuarios'
@stop

@section('contenido')

<h1>Agregar un usuario</h1>
<p>Complete los siguientes campos:</p>

@if($errors->has())
We encountered the following errors:
<ul>
    @foreach($errors->all() as $message)

    <li>{{ $message }}</li>

    @endforeach
</ul>
@endif

<form method="post" action="/admin/usuarios/crear">
    Nombre: <input name="nombre" value="{{Input::old('nombre')}}"/><br/>
    Apellido: <input name="apellido" value="{{Input::old('apellido')}}"/><br/>
    Email: <input name="email" value="{{Input::old('email')}}" placeholder="ejemplo@gmail.com"/><br/>
    DNI: <input name="dni" value="{{Input::old('dni')}}" placeholder="12.345.678"/><br/>
    Teléfono: <input name="teléfono" value="{{Input::old('teléfono')}}" placeholder="(0221) 450-8998"/><br/>
    Provincia:<span class="tooltip" title="Seleccione una provincia de la lista.">[?]</span> <select name="provincia">              
                @foreach($provincias as $provincia)
                    {{'<option value="'. $provincia->id .'">'. $provincia->nombre .'</option>'}}
                @endforeach         </select> 
    Localidad: <input name="localidad" value="{{Input::old('localidad')}}"/><br/>
    Domicilio: <input name="dirección" value="{{Input::old('dirección')}}"/><br/>
    Contraseña: <input type=password name="contraseña" value=""/><br/>
    <br/><br/>
    <input type="submit" value="Guardar" title="Guardar usuario" />       
    <a href="/admin/usuarios/" style="text-decoration:none;">
        <input type="button" value="Cancelar" title="Cancelar la operacion"/>
    </a>
       
</form>

@stop
