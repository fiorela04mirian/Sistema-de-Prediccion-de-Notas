@extends('layouts.sing_up')

@section('content')
<form method="POST" action="{{ route('register') }}" class="theme-form">
    @csrf

    <h4 class="text-center">{{ __('Crea tu cuenta') }}</h4>
    <p class="text-center">Ingresa tus datos personales para crear una cuenta</p>

    <!-- Nombre y Apellido -->
    <div class="form-group">
        <label class="col-form-label pt-0">{{ __('Tu nombre') }}</label>
        <div class="row g-2">
            <div class="col-6">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" 
                    name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="Nombre">
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-6">
                <input id="surname" type="text" class="form-control" name="surname" 
                    placeholder="Apellido" required>
            </div>
        </div>
    </div>

    <!-- Email -->
    <div class="form-group">
        <label class="col-form-label">{{ __('Correo electrónico') }}</label>
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
            name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="ejemplo@gmail.com">
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <!-- Contraseña -->
    <div class="form-group">
        <label class="col-form-label">{{ __('Contraseña') }}</label>
        <div class="form-input position-relative">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                name="password" required autocomplete="new-password" placeholder="*********">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <!-- Confirmar contraseña -->
    <div class="form-group">
        <label class="col-form-label">{{ __('Confirmar contraseña') }}</label>
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" 
            required autocomplete="new-password" placeholder="*********">
    </div>

    <!-- Botón de enviar -->
    <div class="form-group mb-0">
        <button type="submit" class="btn btn-primary btn-block w-100">{{ __('Crear cuenta') }}</button>
    </div>

    <!-- Link a iniciar sesión -->
    <p class="mt-4 mb-0 text-center">
        ¿Ya tienes una cuenta?<a class="ms-2" href="{{ route('login') }}">Iniciar sesión</a>
    </p>
</form>
@endsection
