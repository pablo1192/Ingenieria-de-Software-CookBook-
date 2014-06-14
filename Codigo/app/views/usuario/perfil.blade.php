@extends('template')

@section('contenido')

<h1>Perfil</h1>
<h2>«{{Auth::user()->nombre . ' ' . Auth::user()->apellido}}»</h2>

@if($errors->has())
<ul>
    @foreach($errors->all() as $message)

    <li>{{ $message }}</li>

    @endforeach
</ul>
@endif

<form method="post" action="/perfil">
	<table>
	<tr>
		<td>
		Nombre: <input name="nombre" value="{{Input::old('nombre',Auth::user()->nombre)}}"/><span class="tooltip" title="El nombre debe tener una longitud mayor a 2 caracteres.">[?]</span>
		</td>
	</tr>
	<tr>
		<td>
		Apellido: <input name="apellido" value="{{Input::old('apellido',Auth::user()->apellido)}}"/><span class="tooltip" title="El apellido debe tener una longitud mayor a 2 caracteres.">[?]</span>
		</td>
	</tr>
	<tr>
		<td>
		Email: <input name="email" value="{{Input::old('email',Auth::user()->email)}}"/><span class="tooltip" title="El email debe ser una dirección de correo válida.">[?]</span>
		</td>
	</tr>
	<tr>
		<td>
		DNI: <input name="dni" value="{{Input::old('dni',Auth::user()->dni)}}"/><span class="tooltip" title="El DNI tener 7 u 8 dígitos y debe estar separado por puntos.">[?]</span>
		</td>
	</tr>
	<tr>
		<td>
		Teléfono: <input name="teléfono" value="{{Input::old('teléfono',Auth::user()->teléfono)}}"/> <span class="tooltip" title="El teléfono tener un mínimo de 7 caracteres. Se admiten caracteres especiales (paréntesis, -, #, +, etc).">[?]</span> 
		</td>
	</tr>
	<tr>
		<td style="width:50%">
		Provincia:
		</td>
		<td>
		<select style="width:55%; padding: 0.50em 0.5em; margin: 0.50em 0.5em; right:80%" name="provincia"> 
	                @foreach($provincias as $provincia)
	                	@if($provincia->id == Auth::user()->provincia->id) {
	                    {{'<option value="'. $provincia->id .'" selected="Auth::user()->provincia" >'. $provincia->nombre .'</option>'}};
	                    }
	                    @else{
	                    {{'<option value="'. $provincia->id .'">'. $provincia->nombre .'</option>'}};
	                    }
	                    @endif
	                @endforeach</select>
	    </td> 
	</tr>
	<tr>
		<td>
   		Localidad: <input name="localidad" value="{{Input::old('localidad',Auth::user()->localidad)}}"/> <span class="tooltip" title="Escriba su localidad en 5 o más caracteres.">[?]</span>
   		</td> 
    </tr>
    <tr>
    	<td>
   		Domicilio: <input name="dirección" value="{{Input::old('dirección',Auth::user()->dirección)}}"/> <span class="tooltip" title="Escriba su domicilio en 7 o más caracteres.">[?]</span>
   		</td> 
    </tr>
    <tr>
    	<td>
		Contraseña: <input type=password name="contraseña" value=""/><span class="tooltip" title="La contraseña debe tener una longitud mayor a 5 caracteres.">[?]</span>
		</td>
	</tr>
	<tr>
		<td>
		Reescriba la contraseña: <input type=password name="contraseña_confirmation" value=""/><span class="tooltip" title="Repita la contraseña para confirmar su modificación.">[?]</span> <br/>
		</td>
	</tr>
	</table>
	<br/>
	<input type="submit" value="Modificar" title="Modificar los datos" />		
	<a href="/admin/usuarios/" style="text-decoration:none;">
		<input type="button" value="Cancelar" title="Cancelar la operacion"/>
	</a>
</form>
<h2></h2>
<a href="/eliminar" class="button button-rojo button-mediano" title="Darse de baja" onclick="return confirm('¿Realmente desea darse de baja en el sistema?')">Darse de baja</a> | <strong>Advertencia: Esta operación no puede deshacerse.</strong>
@stop