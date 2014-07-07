@extends('template')

@section('ayuda')
    <a href="javascript: void(0)" onclick="popup('/ayuda#cuenta')"><img width="24" src="/template/images/ayuda.png" alt="Ayuda"/></a>
@overwrite

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

<form method="post" action="/registrarse">
    <table>
    <tr>
        <td>
        Nombre: <input name="nombre" value="{{Input::old('nombre')}}"><span class="tooltip" title="El nombre debe tener una longitud mayor a 2 caracteres.">[?]</span>
        </td>
    </tr>
    <tr>
        <td>
        Apellido: <input name="apellido" value="{{Input::old('apellido')}}"><span class="tooltip" title="El apellido debe tener una longitud mayor a 2 caracteres.">[?]</span>
        </td>
    </tr>
    <tr>
        <td>
        Email: <input name="email" value="{{Input::old('email')}}" placeholder="ejemplo@gmail.com"><span class="tooltip" title="El email debe ser una dirección de correo válida.">[?]</span>
        </td>
    </tr>
    <tr>
        <td>
        DNI: <input name="dni" value="{{Input::old('dni')}}" placeholder="12.345.678"><span class="tooltip" title="El DNI tener 7 u 8 dígitos y debe estar separado por puntos.">[?]</span>
        </td>
    </tr>
    <tr>
        <td>
        Teléfono: <input name="teléfono" value="{{Input::old('teléfono')}}" placeholder="(0221) 450-8998"> <span class="tooltip" title="El teléfono tener un mínimo de 7 caracteres. Se admiten caracteres especiales (paréntesis, -, #, +, etc).">[?]</span> 
        </td>
    </tr>
    <tr>
        <td style="width:50%">
        Provincia:
        </td>
        <td>
        <select style="width:55%; padding: 0.50em 0.5em; margin: 0.50em 0.5em; right:80%" name="provincia"> 
                    @foreach($provincias as $provincia)
                        {{'<option value="'. $provincia->id .'">'. $provincia->nombre .'</option>'}}
                    @endforeach</select>
        </td> 
    </tr>
    <tr>
        <td>
        Localidad: <input name="localidad" value="{{Input::old('localidad')}}"> <span class="tooltip" title="Escriba su localidad en 5 o más caracteres.">[?]</span>
        </td> 
    </tr>
    <tr>
        <td>
        Domicilio: <input name="dirección" value="{{Input::old('dirección')}}"> <span class="tooltip" title="Escriba su domicilio en 7 o más caracteres.">[?]</span>
        </td> 
    </tr>
    <tr>
        <td>
        Contraseña: <input type=password name="contraseña" value=""><span class="tooltip" title="La contraseña debe tener una longitud mayor a 5 caracteres.">[?]</span>
        </td>
    </tr>
    <tr>
        <td>
        Reescriba la contraseña: <input type=password name="contraseña_confirmation" value=""><span class="tooltip" title="Repita la contraseña para confirmar su modificación.">[?]</span> <br/>
        </td>
    </tr>
    </table>
    <br/>
    <input type="submit" value="Registrarse" title="Guardar usuario" />       
    <a href="/login" style="text-decoration:none;">
        <input type="button" value="Cancelar" title="Cancelar la operacion"/>
    </a> 
</form>

@stop