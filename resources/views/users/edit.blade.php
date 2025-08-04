<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.head') <!-- Incluye meta tags, título y enlaces CSS comunes -->
</head>

<body>
    <!-- loader starts-->
    <div class="loader-wrapper">
        <div class="theme-loader">
            <div class="loader-p"></div>
        </div>
    </div>
    <!-- loader ends-->
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on top ends-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        @include('partials.header')
        <div class="page-body-wrapper">
            @include('partials.sidebar')
            <div class="page-body">
                <div class="container-fluid">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-xl-4 col-sm-7 box-col-3">
                                <h3>Dashboard de Predicciones</h3>
                            </div>
                            <div class="col-xl-3 col-sm-5 box-col-4">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">
                                            <svg class="stroke-icon">
                                                <use href="../assets/svg/icon-sprite.svg#stroke-home"></use>
                                            </svg></a></li>
                                    <li class="breadcrumb-item">Dashboard</li>
                                    <li class="breadcrumb-item active">Default</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Container-fluid starts-->
                <div class="card" style="max-width: 500px;">
                    <div class="card-header pb-0">
                        <h4 class="card-title mb-0">Editar Usuario</h4>
                        <div class="card-options">
                            <a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                            <a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('users.update', $user->id) }}">
                            @csrf
                            @method('PUT')

                            <!-- Nombre -->
                            <div class="mb-3">
                                <label class="form-label">Nombre de Usuario</label>
                                <input class="form-control" type="text" name="name" value="{{ old('name', $user->name) }}" required>
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label class="form-label">Correo Electrónico</label>
                                <input class="form-control" type="email" name="email" value="{{ old('email', $user->email) }}" required>
                            </div>

                            <!-- Contraseña actual (obligatoria para cambios) -->
                            <div class="mb-3">
                                <label class="form-label">Contraseña Actual</label>
                                <input class="form-control" type="password" name="current_password" required placeholder="Ingresa tu contraseña actual">
                            </div>

                            <!-- Nueva Contraseña -->
                            <div class="mb-3">
                                <label class="form-label">Nueva Contraseña (Opcional)</label>
                                <input class="form-control" type="password" name="password" placeholder="Nueva contraseña">
                            </div>

                            <!-- Confirmar Nueva Contraseña -->
                            <div class="mb-3">
                                <label class="form-label">Confirmar Nueva Contraseña</label>
                                <input class="form-control" type="password" name="password_confirmation" placeholder="Confirmar nueva contraseña">
                            </div>

                            <!-- Botón Guardar -->
                            <div class="form-footer text-end">
                                <button class="btn btn-primary btn-block" type="submit">Guardar</button>
                            </div>
                        </form>

                    </div>
                </div>
                <!-- Container-fluid Ends-->
            </div>
            @include('partials.footer')
        </div>
    </div>
    @include('partials.scripts')
</body>

</html>
