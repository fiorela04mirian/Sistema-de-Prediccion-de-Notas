<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.head') <!-- Incluye meta tags, título y enlaces CSS comunes -->
    <!-- CSS de jsGrid -->
    <link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jsgrid@1.5.3/dist/jsgrid.min.css" />
    <link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jsgrid@1.5.3/dist/jsgrid-theme.min.css" />

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- JS de jsGrid -->
    <script src="https://cdn.jsdelivr.net/npm/jsgrid@1.5.3/dist/jsgrid.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/jsgrid.css">
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

                                    <!-- Page Sub Header end
                  -->
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
                                    <div class="card-header pb-0">
                                        <div style="display: flex; justify-content: space-between; align-items: center;">
                                            <div>
                                                <h4 class="mb-3">Lista de Parámetros</h4>
                                                <span>Esta tabla muestra los parámetros registrados y permite la creación, edición y eliminación.</span>
                                            </div>

                                            <a href="{{ route('parametros.create') }}" class="btn btn-primary btn-sm">
                                                {{ __('Create New') }}
                                            </a>
                                        </div>
                                    </div>
                                    @if ($message = Session::get('success'))
                                    <div class="alert alert-success m-4">
                                        <p>{{ $message }}</p>
                                    </div>
                                    @endif

                                    <div class="card-body bg-white">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover">
                                                <thead class="thead">
                                                    <tr>
                                                        <th>No</th>

                                                        <th>Fecha</th>
                                                        <th>Hora</th>
                                                        <th>Ph</th>
                                                        <th>Ce</th>
                                                        <th>Tds</th>
                                                        <th>Temp Ambiente</th>
                                                        <th>Temp Solucion</th>
                                                        <th>Humedad Relativa</th>
                                                        <th>Concentracion Oxigeno</th>
                                                        <th>Concentracion Co2</th>
                                                        <th>Iluminacion Diaria</th>
                                                        <th>Irrigacion Diaria</th>

                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($parametros as $parametro)
                                                    <tr>
                                                        <td>{{ ++$i }}</td>

                                                        <td>{{ $parametro->fecha }}</td>
                                                        <td>{{ $parametro->hora }}</td>
                                                        <td>{{ $parametro->ph }}</td>
                                                        <td>{{ $parametro->ce }}</td>
                                                        <td>{{ $parametro->tds }}</td>
                                                        <td>{{ $parametro->temp_ambiente }}</td>
                                                        <td>{{ $parametro->temp_solucion }}</td>
                                                        <td>{{ $parametro->humedad_relativa }}</td>
                                                        <td>{{ $parametro->concentracion_oxigeno }}</td>
                                                        <td>{{ $parametro->concentracion_co2 }}</td>
                                                        <td>{{ $parametro->iluminacion_diaria }}</td>
                                                        <td>{{ $parametro->irrigacion_diaria }}</td>

                                                        <td>
                                                            <form action="{{ route('parametros.destroy', $parametro->id) }}" method="POST">
                                                                <a class="btn btn-sm btn-primary " href="{{ route('parametros.show', $parametro->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                                <a class="btn btn-sm btn-success" href="{{ route('parametros.edit', $parametro->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger btn-sm" onclick="event.preventDefault(); confirm('Are you sure to delete?') ? this.closest('form').submit() : false;"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                {!! $parametros->withQueryString()->links() !!}
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
            $(document).ready(function() {
                // Inicialización de la tabla con jsGrid
                $("#jsGrid").jsGrid({
                    width: "100%",
                    height: "400px",

                    filtering: true,
                    editing: true,
                    inserting: true,
                    sorting: true,
                    paging: true,
                    autoload: true,

                    // Conexión a la ruta correcta del CRUD
                    controller: {
                        loadData: function(filter) {
                            return $.ajax({
                                type: "GET",
                                url: "{{ route('parametros.index') }}", // Aquí usamos la ruta RESTful generada por Laravel
                                data: filter
                            });
                        },
                        insertItem: function(item) {
                            return $.ajax({
                                type: "POST",
                                url: "{{ route('parametros.store') }}", // Ruta para crear parámetros
                                headers: {
                                    'X-CSRF-TOKEN': "{{ csrf_token() }}" // Agregar token CSRF
                                },
                                data: item
                            });
                        },
                        updateItem: function(item) {
                            return $.ajax({
                                type: "PUT",
                                url: "/parametros/" + item.id, // Usar URL dinámica basada en el ID del parámetro
                                headers: {
                                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                                },
                                data: item
                            });
                        },
                        deleteItem: function(item) {
                            return $.ajax({
                                type: "DELETE",
                                url: "/parametros/" + item.id, // URL RESTful para eliminar
                                headers: {
                                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                                }
                            });
                        }
                    },

                    fields: [{
                            name: "fecha",
                            type: "text",
                            title: "Fecha",
                            width: 70,
                            validate: "required"
                        },
                        {
                            name: "hora",
                            type: "text",
                            title: "Hora",
                            width: 50
                        },
                        {
                            name: "ph",
                            type: "number",
                            title: "PH",
                            width: 50
                        },
                        {
                            name: "ce",
                            type: "number",
                            title: "CE",
                            width: 50
                        },
                        {
                            name: "tds",
                            type: "number",
                            title: "TDS",
                            width: 50
                        },
                        {
                            name: "temp_ambiente",
                            type: "number",
                            title: "Temp. Ambiente",
                            width: 70
                        },
                        {
                            name: "temp_solucion",
                            type: "number",
                            title: "Temp. Solución",
                            width: 70
                        },
                        {
                            name: "humedad_relativa",
                            type: "number",
                            title: "Humedad Relativa",
                            width: 70
                        },
                        {
                            name: "concentracion_oxigeno",
                            type: "number",
                            title: "Concentración Oxígeno",
                            width: 80
                        },
                        {
                            name: "concentracion_co2",
                            type: "number",
                            title: "Concentración CO2",
                            width: 80
                        },
                        {
                            name: "iluminacion_diaria",
                            type: "number",
                            title: "Iluminación Diaria",
                            width: 80
                        },
                        {
                            name: "irrigacion_diaria",
                            type: "number",
                            title: "Irrigación Diaria",
                            width: 80
                        },
                        {
                            type: "control", // Botones para editar/eliminar
                            editButton: true,
                            deleteButton: true
                        }
                    ]
                });
            });
        </script>


    </body>

</html>