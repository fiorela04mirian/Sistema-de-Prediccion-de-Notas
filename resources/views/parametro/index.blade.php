<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.head') <!-- Incluye meta tags, título y enlaces CSS comunes -->
</head>

<body>

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
        <!-- tap on tap ends-->
        <!-- page-wrapper Start   -->
        <div class="page-wrapper compact-wrapper" id="pageWrapper">
            <!-- Page Header Start -->
            @include('partials.header')
            <!-- Page Header Ends                              -->
            <!-- Page body Start -->
            <div class="page-body-wrapper">
                <!-- Page Sidebar Start-->
                @include('partials.sidebar')
                <!-- Page Sidebar Ends-->
                <div class="page-body">
                    <div class="container-fluid">
                        <div class="page-title">
                            <div class="row">
                                <div class="col-xl-4 col-sm-7 box-col-3">
                                    <h3>Dashboard de Predicciones</h3>
                                </div>
                                <div class="col-5 d-none d-xl-block">
                                    <!-- Page Sub Header Start-->
                                    <!-- Page Sub Header end-->
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
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-header pb-0 card-no-border d-flex align-items-center gap-2">
                                        <h4 class="mb-0">Registro de Notas</h4>
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createParametroModal">
                                            {{ __('Añadir') }}
                                        </button>
                                    </div>
                                    @if ($message = Session::get('success'))
                                    <div class="alert alert-success m-4">
                                        <p>{{ $message }}</p>
                                    </div>
                                    @endif
                                    <div class="card-body">
                                        <div class="table-responsive custom-scrollbar user-datatable theme-scrollbar text-center">
                                            <table class="display custom-scrollbar" id="basic-12">
                                                <thead>
                                                    <tr>
                                                        <th>Fecha</th>
                                                        <th>Hora</th>
                                                        <th>Nota 1</th>
                                                        <th>Nota 2</th>
                                                        <th>Nota 3</th>
                                                        <th>Promedio Predicho</th>
                                                        <th>Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php $i = 1; @endphp
                                                    @foreach ($parametros as $fecha => $bloques)
                                                    @foreach ($bloques as $index => $bloque)
                                                    <tr>
                                                        <td>{{ $index === 0 ? $fecha : '' }}</td> <!-- Solo la primera fila muestra la fecha -->
                                                        <td>
                                                            @foreach ($bloque as $parametro)
                                                            <p>{{ $parametro->hora }}</p>
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            @foreach ($bloque as $parametro)
                                                            <p>{{ $parametro->nota1 }}</p>
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            @foreach ($bloque as $parametro)
                                                            <p>{{ $parametro->nota2 }}</p>
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            @foreach ($bloque as $parametro)
                                                            <p>{{ $parametro->nota3 }}</p>
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            @foreach ($bloque as $parametro)
                                                            <p>{{ $parametro->promedio_predicho }}</p>
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            <a href="#" class="text-primary me-2" data-bs-toggle="modal" data-bs-target="#editParametroModal{{ $parametro->id }}">
                                                                <i class="icon-pencil-alt"></i>
                                                            </a>
                                                            <form action="{{ route('parametros.destroy', $parametro->id) }}" method="POST" class="d-inline-block">
                                                                @csrf
                                                                @method('DELETE')
                                                                <a href="#" class="text-danger" onclick="event.preventDefault(); if(confirm('¿Estás seguro de eliminar este bloque?')) this.closest('form').submit();">
                                                                    <i class="icon-trash"></i>
                                                                </a>
                                                            </form>
                                                        </td>
                                                    </tr>

                                                    <!-- Modal Editar Parámetro (Diseño actualizado) -->
                                                    <div class="modal fade" id="editParametroModal{{ $parametro->id }}" tabindex="-1" aria-labelledby="editParametroModalLabel{{ $parametro->id }}" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title" id="editParametroModalLabel{{ $parametro->id }}">{{ __('Editar Parámetros del Bloque') }}</h4>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="{{ route('parametros.update', $parametro->id) }}" method="POST">
                                                                        @csrf
                                                                        @method('PUT')

                                                                        <div class="row mb-2">
                                                                            <div class="col-md-3">
                                                                                <label for="fecha" class="form-label">{{ __('Fecha del Registro') }}</label>
                                                                                <input type="date" name="fecha" class="form-control form-control-sm" value="{{ $parametro->fecha }}" readonly>
                                                                            </div>
                                                                        </div>

                                                                        @foreach ($bloque as $param)
                                                                        <div class="row border rounded p-2 mb-3">
                                                                            <input type="hidden" name="id[]" value="{{ $param->id }}">
                                                                            <div class="col-md-4 d-flex align-items-center">
                                                                                <label for="hora" class="form-label me-2">{{ __('Hora del Registro') }}</label>
                                                                                <input type="time" name="hora[]" class="form-control form-control-sm" value="{{ $param->hora }}" required>
                                                                            </div>
                                                                            <div class="col-md-12 d-flex pt-2">
                                                                                <div class="me-2">
                                                                                    <label for="nota1" class="form-label">{{ __('Nota 1') }}</label>
                                                                                    <input type="number" step="0.001" name="nota1[]" class="form-control form-control-sm" value="{{ $param->nota1 }}" required>
                                                                                </div>
                                                                                <div class="me-2">
                                                                                    <label for="nota2" class="form-label">{{ __('Nota 2') }}</label>
                                                                                    <input type="number" step="0.001" name="nota2[]" class="form-control form-control-sm" value="{{ $param->nota2 }}" required>
                                                                                </div>
                                                                                <div class="me-2">
                                                                                    <label for="nota3" class="form-label">{{ __('Nota 3') }}</label>
                                                                                    <input type="number" step="0.001" name="nota3[]" class="form-control form-control-sm" value="{{ $param->nota3 }}" required>
                                                                                </div>
                                                                                
                                                                            </div>
                                                                        </div>
                                                                        @endforeach

                                                                        <div class="text-center">
                                                                            <button type="submit" class="btn btn-success">{{ __('Guardar Cambios') }}</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    @endforeach
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>Fecha</th>
                                                        <th>Hora</th>
                                                        <th>Nota 1</th>
                                                        <th>Nota 2</th>
                                                        <th>Nota 3</th>
                                                        <th>Promedio Predicho</th>
                                                        <th>Acciones</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- footer start-->
            </div>
        </div>
        @include('partials.scripts')

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const form = document.querySelector('#createParametroForm'); // ID del formulario
                const submitButton = form.querySelector('button[type="submit"]'); // Botón de envío

                submitButton.addEventListener('click', function(event) {
                    let valid = true;

                    // Validar campos dinámicos (fecha y registros por iteración)
                    const requiredFields = form.querySelectorAll('input[required]');
                    requiredFields.forEach(field => {
                        if (!field.value) {
                            valid = false;
                            field.classList.add('is-invalid'); // Estilo de error si no es válido
                        } else {
                            field.classList.remove('is-invalid'); // Remover error si es válido
                        }
                    });

                    // Verificar si la fecha ya está registrada antes de enviar el formulario
                    const fecha = form.querySelector('#fecha').value; // Obtén la fecha seleccionada

                    // Llamar al backend para verificar si la fecha ya existe
                    fetch(`/validar-fecha/${fecha}`, {
                            method: 'GET',
                            headers: {
                                'Content-Type': 'application/json',
                            },
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.exists) {
                                valid = false;
                                alert('La fecha ya está registrada. Por favor, elige otra.');
                                // Prevenir el envío del formulario si la fecha ya está registrada
                                event.preventDefault();
                            }

                            // Si todo es válido, proceder con el envío del formulario
                            if (!valid) {
                                event.preventDefault();
                            }
                        })
                        .catch(error => {
                            console.error('Error al verificar la fecha:', error);
                            event.preventDefault();
                        });

                    // Si hay algún campo inválido, prevenir el envío del formulario
                    if (!valid) {
                        event.preventDefault();
                        alert('Por favor, llena todos los campos antes de guardar.');
                    }
                });

                // Restaurar los valores originales al cerrar ambos modales (crear y editar)
                document.querySelectorAll(".modal").forEach(function(modal) {
                    modal.addEventListener("hidden.bs.modal", function(event) {
                        modal.querySelectorAll("input").forEach(function(input) {
                            input.value = input.defaultValue; // Restaurar valor original
                        });
                    });
                });

            });
        </script>



    </body>

</html>
<div class="modal fade" id="createParametroModal" tabindex="-1" aria-labelledby="createParametroModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="createParametroModalLabel">{{ __('Ingresar Notas del Estudiante') }}</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>

            </div>
            <div class="modal-body">
                <form id="createParametroForm" action="{{ route('parametros.store') }}" method="POST">
                    @csrf
                    <div class="row mb-2">
                        <div class="col-md-4">
                            <label for="fecha" class="form-label">{{ __('Fecha del Registro') }}</label>
                            <input type="date" name="fecha" class="form-control form-control-sm" id="fecha" required>
                        </div>
                    </div>

                    @for ($i = 1; $i <= 3; $i++)
                        <div class="row border rounded p-3 mb-3">
                        <div class="col-md-4 d-flex align-items-center">
                            <label for="hora{{ $i }}" class="form-label me-2">{{ __('Hora del Registro') }}</label>
                            <input type="time" name="hora{{ $i }}" class="form-control form-control-sm" id="hora{{ $i }}" required>
                        </div>
                        <div class="col-md-12 d-flex pt-2">
                            <div class="me-2">
                                <label for="nota1{{ $i }}" class="form-label">{{ __('Nota 1') }}</label>
                                <input type="number" step="0.001" name="nota1{{ $i }}" class="form-control form-control-sm" id="nota1{{ $i }}" required>
                            </div>
                            <div class="me-2">
                                <label for="nota2{{ $i }}" class="form-label">{{ __('Nota 2') }}</label>
                                <input type="number" step="0.001" name="nota2{{ $i }}" class="form-control form-control-sm" id="nota2{{ $i }}" required>
                            </div>
                            <div class="me-2">
                                <label for="nota3{{ $i }}" class="form-label">{{ __('Nota 3') }}</label>
                                <input type="number" step="0.001" name="nota3{{ $i }}" class="form-control form-control-sm" id="nota3{{ $i }}" required>
                            </div>
                            
                        </div>
            </div>
            @endfor
            <div class="text-center">
                <button type="submit" class="btn btn-success">{{ __('Guardar Parámetros') }}</button>
            </div>
            </form>

        </div>

        </form>
    </div>
</div>
</div>
</div>