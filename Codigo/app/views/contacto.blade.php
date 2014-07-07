@extends('template')

@section('ayuda')
    <a href="javascript: void(0)" onclick="popup('/ayuda#contacto')"><img width="24" src="/template/images/ayuda.png" alt="Ayuda"/></a>
@overwrite

@section('menuActivo')
menuActivo='contacto'
@stop

@section('contenido')
<a name="area"></a>
<h2>Contacto</h2>
	<p>Puede ponerse en contacto con <strong class="cookbook">Cookbook</strong> através del siguiente formulario. El Administrador se pondrá en contacto a través de su correo electrónico.</p>
	@if(Session::has('mensajeEnviado'))
		<div class="mensaje mensaje-info">
			{{Session::get('mensajeEnviado')}}
		</div>		
	@elseif(count($errors) > 0)
		<div>
			<p class="rojo">Error al enviar el mensaje:</p>
			<ul>
				@foreach(($errors->all()) as $mensajeDeError)
				<li>{{$mensajeDeError}}</li>
				@endforeach
			</ul>
		</div>
	@endif
	
	<form method="post" action="/contacto" >
		<table width="450px">
		<tr>
			<td>Asunto:</td>
			<td>
				<input name="asunto" value="" size="35" placeholder="Asunto"/>
			</td>
		</tr>
		<tr>
			<td valign="top">Mensaje:</td>
			<td>
				<textarea name="cuerpo" size="20" placeholder="Escriba aquí su mensaje"></textarea>
			</td>
		</tr>
		<tr>
			<td>
				<input type="submit" value="Enviar"/>
			</td>
			<td></td>
		</tr>
		</table>
		<input name="usuario" type="hidden" value="{{Auth::user()->id}}" />
	</form>
@stop
