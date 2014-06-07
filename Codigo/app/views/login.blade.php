@extends('template')

@section('contenido')

<html>
<head>
	<title>Login</title>
</head>

<body>

	{{ Form::open(array('url' => 'login')) }}
		<h1>Login</h1>

		@if ($alert = Session::get('ingreso-fallido'))
		    <div class="alert alert-warning">
		        {{ $alert }}
		    </div>
		@endif

		@if ($alert = Session::get('cuenta-invalida'))
		    <div class="alert alert-warning">
		        {{ $alert }}
		    </div>
		@endif

		<p>
			{{ $errors->first('email') }}<br/>
			{{ $errors->first('contraseña') }}
		</p>

		<p>
			{{ Form::label('email', 'Email') }}
			{{ Form::text('email', Input::old('email'), array('placeholder' => 'ejemplo@gmail.com')) }}
		</p>

		<p>
			{{ Form::label('contraseña', 'Contraseña') }}
			{{ Form::password('contraseña') }}
		</p>

		<p>{{ Form::submit('Ingresar') }}</p>
	{{ Form::close() }}

</body>
</html>

@stop