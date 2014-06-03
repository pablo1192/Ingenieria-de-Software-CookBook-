@extends('admin')

@section('contenido')

<html>
<head>
	<title>Login</title>
</head>

<body>

	{{ Form::open(array('url' => 'login')) }}
		<h1>Login</h1> </br>

		@if ($alert = Session::get('ingreso-fallido'))
		    <div class="alert alert-warning">
		        {{ $alert }}
		    </div>
		@endif

		<p>
			{{ $errors->first('email') }}<br/>
			{{ $errors->first('contraseña') }}
		</p>

		<p>
			{{ Form::label('email', 'Email Address') }}
			{{ Form::text('email', Input::old('email'), array('placeholder' => 'ejemplo@hotmail.com')) }}
		</p>

		<p>
			{{ Form::label('contraseña', 'Contraseña') }}
			{{ Form::password('contraseña') }}
		</p>

		<p>{{ Form::submit('Submit!') }}</p>
	{{ Form::close() }}

</body>
</html>

@stop