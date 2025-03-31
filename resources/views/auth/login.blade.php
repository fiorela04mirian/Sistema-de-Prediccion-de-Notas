@extends('layouts.login_one')

@section('content')
<form class="theme-form" method="POST" action="{{ route('login') }}">
        @csrf
        <h3>Iniciar sesión en tu cuenta</h3>
        <p>Ingresa tu correo electrónico y contraseña para iniciar sesión</p>

        <!-- Campo de email -->
        <div class="form-group">
            <label class="col-form-label">Dirección de correo</label>
            <input class="form-control @error('email') is-invalid @enderror" id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="ejemplo@gmail.com">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <!-- Campo de contraseña -->
        <div class="form-group">
            <label class="col-form-label">Contraseña</label>
            <div class="form-input position-relative">
                <input class="form-control @error('password') is-invalid @enderror" id="password" type="password" name="password" required autocomplete="current-password" placeholder="*********">
                
            </div>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <!-- Recordar contraseña -->
        <div class="form-group mb-0">
            

            <button class="btn btn-primary btn-block w-100" type="submit">Iniciar sesión</button>

            <p class="mt-4 mb-0 text-center">
                ¿No tienes una cuenta?<a class="ms-2" href="{{ route('register') }}">Crear cuenta</a>
            </p>
        </div>
    </form>
@endsection
