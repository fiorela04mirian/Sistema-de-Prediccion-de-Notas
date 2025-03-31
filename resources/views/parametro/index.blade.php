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
                                    <h3>Dashboard de Hidroponia</h3>
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
                    <!-- Container-fluid starts-->
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-header pb-0 card-no-border d-flex align-items-center gap-2">
                                        <h4 class="mb-0">Registro Diario de Parámetros</h4>
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
                                        <div class="table-responsive custom-scrollbar user-datatable theme-scrollbar">
                                            <table class="display custom-scrollbar" id="basic-12">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Fecha</th>
                                                        <th>Hora</th>
                                                        <th>CE</th>
                                                        <th>pH</th>
                                                        <th>Temp Ambiente</th>
                                                        <th>Temp Solución</th>
                                                        <th>Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php $i = 1; @endphp
                                                    @foreach ($parametros as $fecha => $bloques)
                                                    @foreach ($bloques as $index => $bloque)
                                                    <tr>
                                                        <td>{{ $i++ }}</td>
                                                        <td>{{ $index === 0 ? $fecha : '' }}</td> <!-- Solo la primera fila muestra la fecha -->
                                                        <td>
                                                            @foreach ($bloque as $parametro)
                                                            <p>{{ $parametro->hora }}</p>
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            @foreach ($bloque as $parametro)
                                                            <p>{{ $parametro->ce }}</p>
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            @foreach ($bloque as $parametro)
                                                            <p>{{ $parametro->ph }}</p>
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            @foreach ($bloque as $parametro)
                                                            <p>{{ $parametro->temp_ambiente }}</p>
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            @foreach ($bloque as $parametro)
                                                            <p>{{ $parametro->temp_solucion }}</p>
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
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="{{ route('parametros.update', $parametro->id) }}" method="POST">
                                                                        @csrf
                                                                        @method('PUT')

                                                                        <div class="row mb-2">
                                                                            <div class="col-md-6">
                                                                                <label for="fecha" class="form-label">{{ __('Fecha del Registro') }}</label>
                                                                                <input type="date" name="fecha" class="form-control form-control-sm" value="{{ $parametro->fecha }}" required>
                                                                            </div>
                                                                        </div>

                                                                        @foreach ($bloque as $param)
                                                                        <div class="row border rounded p-2 mb-3">
                                                                            <div class="col-md-6 d-flex align-items-center">
                                                                                <label for="hora" class="form-label me-2">{{ __('Hora del Registro') }}</label>
                                                                                <input type="time" name="hora[]" class="form-control form-control-sm" value="{{ $param->hora }}" required>
                                                                            </div>
                                                                            <div class="col-md-12 d-flex pt-2">
                                                                                <div class="me-2">
                                                                                    <label for="ce" class="form-label">{{ __('CE (dS/m)') }}</label>
                                                                                    <input type="number" step="0.01" name="ce[]" class="form-control form-control-sm" value="{{ $param->ce }}" required>
                                                                                </div>
                                                                                <div class="me-2">
                                                                                    <label for="ph" class="form-label">{{ __('pH') }}</label>
                                                                                    <input type="number" step="0.01" name="ph[]" class="form-control form-control-sm" value="{{ $param->ph }}" required>
                                                                                </div>
                                                                                <div class="me-2">
                                                                                    <label for="temp_ambiente" class="form-label">{{ __('Temp. Ambiente (°C)') }}</label>
                                                                                    <input type="number" step="0.1" name="temp_ambiente[]" class="form-control form-control-sm" value="{{ $param->temp_ambiente }}" required>
                                                                                </div>
                                                                                <div>
                                                                                    <label for="temp_solucion" class="form-label">{{ __('Temp. Solución (°C)') }}</label>
                                                                                    <input type="number" step="0.1" name="temp_solucion[]" class="form-control form-control-sm" value="{{ $param->temp_solucion }}" required>
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
                                                        <th>No</th>
                                                        <th>Fecha</th>
                                                        <th>Hora</th>
                                                        <th>CE</th>
                                                        <th>pH</th>
                                                        <th>Temp Ambiente</th>
                                                        <th>Temp Solución</th>
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
                    <!-- Container-fluid Ends-->
                </div>
                <!-- footer start-->
                @include('partials.footer')
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

                    // Si hay algún campo inválido, prevenir el envío del formulario
                    if (!valid) {
                        event.preventDefault();
                        alert('Por favor, llena todos los campos antes de guardar.');
                    }
                });
            });
        </script>

    </body>

</html>
<div class="modal fade" id="createParametroModal" tabindex="-1" aria-labelledby="createParametroModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="createParametroModalLabel">{{ __('Crear Parámetro Diario') }}</h4>
            </div>
            <div class="modal-body">
                <form id="createParametroForm" action="{{ route('parametros.store') }}" method="POST">
                    @csrf
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <label for="fecha" class="form-label">{{ __('Fecha del Registro') }}</label>
                            <input type="date" name="fecha" class="form-control form-control-sm" id="fecha" required>
                        </div>
                    </div>

                    @for ($i = 1; $i <= 3; $i++)
                        <div class="row border rounded p-2 mb-3">
                        <div class="col-md-6 d-flex align-items-center">
                            <label for="hora{{ $i }}" class="form-label me-2">{{ __('Hora del Registro') }}</label>
                            <input type="time" name="hora{{ $i }}" class="form-control form-control-sm" id="hora{{ $i }}" required>
                        </div>
                        <div class="col-md-12 d-flex pt-2">
                            <div class="me-2">
                                <label for="ce{{ $i }}" class="form-label">{{ __('CE (dS/m)') }}</label>
                                <input type="number" step="0.01" name="ce{{ $i }}" class="form-control form-control-sm" id="ce{{ $i }}" required>
                            </div>
                            <div class="me-2">
                                <label for="ph{{ $i }}" class="form-label">{{ __('pH') }}</label>
                                <input type="number" step="0.01" name="ph{{ $i }}" class="form-control form-control-sm" id="ph{{ $i }}" required>
                            </div>
                            <div class="me-2">
                                <label for="temp_amb{{ $i }}" class="form-label">{{ __('Temp. Ambiente (°C)') }}</label>
                                <input type="number" step="0.1" name="temp_amb{{ $i }}" class="form-control form-control-sm" id="temp_amb{{ $i }}" required>
                            </div>
                            <div>
                                <label for="temp_sol{{ $i }}" class="form-label">{{ __('Temp. Solución (°C)') }}</label>
                                <input type="number" step="0.1" name="temp_sol{{ $i }}" class="form-control form-control-sm" id="temp_sol{{ $i }}" required>
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