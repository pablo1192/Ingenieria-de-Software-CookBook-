@extends('template')

@section('ayuda')
    <a href="javascript: void(0)" onclick="popup('/ayuda#cuenta')"><img width="24" src="/template/images/ayuda.png" alt="Ayuda"/></a>
@overwrite

@section('contenido')

<h1>Restablecer la contraseña</h1>

</br>
@if($errors->has())
<ul>
    @foreach($errors->all() as $message)
    <li>{{ $message }}</li>
    @endforeach
</ul>
@endif

@if ($alert = Session::get('ingreso-fallido'))
    <div class="alert alert-warning">
        {{ $alert }}
    </div></br>
@endif

@if ($alert = Session::get('cuenta-invalida'))
    <div class="alert alert-warning">
        {{ $alert }}
    </div></br>
@endif

Se le enviará un email de confirmación a la dirección de correo con la que se registró.</br></br>
<form method="post" action="/resetear">
	<table>
	    <tr>Ingrese su email:</tr></br>
	    <tr><input name="email" value="{{Input::old('email')}}" placeholder="ejemplo@gmail.com"></tr></br></br>
	</table>
    <br/>
    <input type="submit" value="Restablecer" title="Restablece la contraseña" onclick="return confirm('¿Seguro que desea restablecer su contraseña?')">       
</form>
@stop