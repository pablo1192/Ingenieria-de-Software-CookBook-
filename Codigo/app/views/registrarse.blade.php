@extends('template')

@section('contenido')

<h1>Registrarse en el sistema</h1>

</br>
@if($errors->has())
<ul>
    @foreach($errors->all() as $message)
    <li>{{ $message }}</li>
    @endforeach
</ul>
@endif

<p>Complete los siguientes campos:</p>
<form method="post" action="/registrarse">
    Nombre: <input name="nombre" value="{{Input::old('nombre')}}"/> <span class="tooltip" title="El nombre debe tener una longitud mayor a 2 caracteres.">[?]</span> <br/>
    Apellido: <input name="apellido" value="{{Input::old('apellido')}}"/> <span class="tooltip" title="El apellido debe tener una longitud mayor a 2 caracteres.">[?]</span> <br/>
    Email: <input name="email" value="{{Input::old('email')}}" placeholder="ejemplo@gmail.com"/> <span class="tooltip" title="El email debe ser una dirección de correo válida.">[?]</span> <br/>
    DNI: <input name="dni" value="{{Input::old('dni')}}" placeholder="12.345.678"/> <span class="tooltip" title="El DNI tener 7 u 8 dígitos y debe estar separado por puntos.">[?]</span> <br/>
    Teléfono: <input name="teléfono" value="{{Input::old('teléfono')}}" placeholder="(0221) 450-8998"/> <span class="tooltip" title="El teléfono tener un mínimo de 7 caracteres. Se admiten caracteres especiales.">[?]</span> <br/>
    Provincia:<span class="tooltip" title="Seleccione una provincia de la lista.">[?]</span> <select name="provincia">              
                @foreach($provincias as $provincia)
                    {{'<option value="'. $provincia->id .'">'. $provincia->nombre .'</option>'}}
                @endforeach         </select> 
    Localidad: <input name="localidad" value="{{Input::old('localidad')}}"/> <span class="tooltip" title="Escriba su localidad en 5 o más caracteres.">[?]</span> <br/>
    Dirección: <input name="dirección" value="{{Input::old('dirección')}}"/> <span class="tooltip" title="Escriba su domicilio en 7 o más caracteres.">[?]</span> <br/>
    Contraseña: <input type=password name="contraseña" value=""/> <span class="tooltip" title="La contraseña debe tener una longitud mayor a 5 caracteres.">[?]</span> <br/>
    Reescriba la contraseña: <input type=password name="contraseña_confirmation" value=""/> <span class="tooltip" title="Repita la contraseña para confirmar su registro.">[?]</span> <br/>
    <input type="submit" value="Guardar" title="Guardar usuario" />       
    <a href="/login" style="text-decoration:none;">
        <input type="button" value="Cancelar" title="Cancelar la operacion"/>
    </a>   
</form>

@stop