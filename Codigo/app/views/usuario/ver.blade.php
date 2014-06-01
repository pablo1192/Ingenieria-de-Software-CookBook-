{{-- Vieja view para testing. No utilizada por el momento --}}

@extends('admin')
 
@section('content')
        {{ HTML::link('usuarios', 'Volver'); }}
        <h1>
  Usuario {{$usuario->id}}
      
</h1>
        
        {{ $usuario->nombre .' '.$usuario->apellido }}

<br />

        {{ $usuario->dni .' '.$usuario->email }}
        
<br />

        {{ $usuario->contraseña}}

<br />
        {{ $usuario->created_at}}
@stop