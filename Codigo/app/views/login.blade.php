@extends('template')

@section('ayuda')
    <a href="javascript: void(0)" onclick="popup('/ayuda#cuenta')"><img width="24" src="/template/images/ayuda.png" alt="Ayuda"/></a>
@overwrite

@section('contenido')

<h1>Login</h1>

</br>
@if($errors->has())
<ul>
    @foreach($errors->all() as $message)
    <li>{{ $message }}</li>
    @endforeach
</ul>
@endif

@if (($alert = Session::get('ingreso-fallido')) || ($alert = Session::get('cuenta-invalida')) || ($alert = Session::get('email-fallido')) || ($alert = Session::get('email-encontrado')))
    <div class="alert alert-warning">
        {{ $alert }}
    </div></br>
@endif

<form method="post" action="/login">
<table>
	    <tr>Email:</tr></br>
	    <tr><input name="email" value="{{Input::old('email')}}" placeholder="ejemplo@gmail.com"></tr></br></br>
	    <tr>Contraseña:</tr></br>
	    <tr><input type=password name="contraseña" value=""></tr></br>
    </table>
    <br/>
    <input type="submit" value="Ingresar" title="Ingresar al sistema" />       
</form>

<h2></h2>
<a href="/resetear" style="text-decoration:none;">Restablecer la contraseña.</a> 

@stop