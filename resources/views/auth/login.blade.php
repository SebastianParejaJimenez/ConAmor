@extends('layouts.auth_app')
@section('title')
Login
@endsection
@section('content')
<div class="section-header">
        <div class="section-body">
                    <h2 class="section-title"><b>ConAmor</b></h2>
                    <p class="section-lead">El siguiente formulario le permitira ingresar al sistema digitando su usario registrado.</p>
        </div>
</div>
<div class="card card-primary">
    <div class="card-body">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            @if ($errors->any())
            <div class="alert alert-danger p-0">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="form-group">
                <label for="email">Correo</label>
                <input aria-describedby="emailHelpBlock" id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" placeholder="Ingresa el Email" tabindex="1" value="{{ (Cookie::get('email') !== null) ? Cookie::get('email') : old('email') }}" autofocus required>
                <div class="invalid-feedback">
                    {{ $errors->first('email') }}
                </div>
            </div>

            <div class="form-group">
                <div class="d-block">
                    <label for="password" class="control-label">Contraseña</label>

                </div>
                <input aria-describedby="passwordHelpBlock" id="password" type="password" value="{{ (Cookie::get('password') !== null) ? Cookie::get('password') : null }}" placeholder="Ingresa la Contraseña" class="form-control{{ $errors->has('password') ? ' is-invalid': '' }}" name="password" tabindex="2" required>
                <div class="invalid-feedback">
                    {{ $errors->first('password') }}
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                    Ingresar
                </button>
            </div>
            <div class="mt-5 text-muted text-center">
<!--                 ¿No estas Registrado? <a href="{{ route('register') }}">Registrarse</a>
 -->            </div>
        </form>
    </div>
</div>
@endsection