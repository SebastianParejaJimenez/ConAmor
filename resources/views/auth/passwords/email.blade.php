@extends('layouts.auth_app')
@section('title')
    Forgot Password
@endsection
@section('content')
    <div class="card card-primary">
        <div class="card-header"><h4>Reiniciar Contraseña</h4></div>
        <p class="section-lead">A continuacion debe de ingresar su Correo para poder recibir un link de confirmacion el cual le permitira reestablecer su contraseña.</p>

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>

                <div class="alert alert-primary">Si al momento de enviar el link no lo ves revisa tu carpeta de spam!</div>

            @endif
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="form-group">
                    <label for="email">Correo</label>
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                           name="email" tabindex="1" value="{{ old('email') }}" autofocus required>
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                        Enviar Link
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="mt-5 text-muted text-center">
        ¿Quieres volver al Login? <a href="{{ route('login') }}">Iniciar Sesión</a>
    </div>
@endsection
