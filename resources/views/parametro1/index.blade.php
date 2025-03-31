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
                                    <h3>Dashboard de Hidroponia</h3>

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
                                                        <th>CE</th>
                                                        <th>PH (uS/cm)</th>
                                                        <th>Temp. Ambiente (°C)</th>
                                                        <th>Temp. Solución Nutritiva (°C)</th>
                                                        <th>Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($parametros as $fecha => $grupo)
                                                    @php $first = true; @endphp
                                                    @foreach ($grupo as $parametro)
                                                    <tr>
                                                        @if ($first)
                                                        <td rowspan="{{ $grupo->count() }}">{{ $loop->parent->iteration }}</td>
                                                        <td rowspan="{{ $grupo->count() }}">{{ $fecha }}</td>
                                                        @php $first = false; @endphp
                                                        @endif
                                                        <td>{{ $parametro->hora }}</td>
                                                        <td>{{ $parametro->ce }}</td>
                                                        <td>{{ $parametro->ph }}</td>
                                                        <td>{{ $parametro->temp_ambiente }}</td>
                                                        <td>{{ $parametro->temp_solucion }}</td>
                                                        <td>
                                                            <a href="#" class="text-primary me-2" data-bs-toggle="modal" data-bs-target="#editParametroModal{{ $parametro->id }}">
                                                                <i class="fa fa-edit"></i>
                                                            </a>
                                                            <form action="{{ route('parametros.destroyGroup') }}" method="POST" class="d-inline-block">
                                                                @csrf
                                                                @method('DELETE')
                                                                <input type="hidden" name="fecha" value="{{ $fecha }}">
                                                                <a href="#" class="text-danger" onclick="event.preventDefault(); if(confirm('¿Estás seguro de eliminar este grupo de parámetros?')) this.closest('form').submit();">
                                                                    <i class="fa fa-trash"></i>
                                                                </a>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                {!! $parametros->withQueryString()->links() !!}
                            </div>

                            <div class="card">
                                <div class="card-header pb-0">
                                    <h4 class="mb-3">Basic Scenario </h4>
                                    <span>Grid with filtering, editing, inserting, deleting, sorting and paging. Data provided by controller.</span>
                                </div>
                                <div class="card-body">
                                    <div class="basic_table" id="basicScenario"></div>
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
        <script src="../assets/js/jsgrid/jsgrid.min.js"></script>
        <script src="../assets/js/jsgrid/griddata.js"></script>
        <!-- <script src="../assets/js/jsgrid/jsgrid.js"></script> -->
        <script>
            $(function() {
                $("#basicScenario").jsGrid({
                    width: "100%",
                    filtering: true,
                    editing: true,
                    inserting: true,
                    sorting: true,
                    paging: true,
                    autoload: true,
                    pageSize: 15,
                    pageButtonCount: 5,
                    deleteConfirm: "¿Realmente quieres eliminar este parámetro?",
                    controller: {
                        loadData: function(filter) {
                            return $.ajax({
                                type: "GET",
                                url: "{{ route('parametros.index') }}",
                                data: filter
                            });
                        },
                        insertItem: function(item) {
                            return $.ajax({
                                type: "POST",
                                url: "{{ route('parametros.store') }}",
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                data: item
                            });
                        },
                        updateItem: function(item) {
                            return $.ajax({
                                type: "PUT",
                                url: "{{ url('parametros') }}/" + item.id,
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                data: item
                            });
                        },
                        deleteItem: function(item) {
                            return $.ajax({
                                type: "DELETE",
                                url: "{{ url('parametros') }}/" + item.id,
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                }
                            });
                        }
                    },
                    fields: [{
                            name: "id",
                            type: "number",
                            width: 30,
                            title: "No",
                            readOnly: true
                        },
                        {
                            name: "fecha",
                            type: "text",
                            title: "Fecha",
                            width: 100
                        },
                        {
                            name: "hora",
                            type: "text",
                            title: "Hora",
                            width: 100
                        },
                        {
                            name: "ph",
                            type: "number",
                            title: "Ph",
                            width: 70
                        },
                        {
                            name: "ce",
                            type: "number",
                            title: "Ce",
                            width: 70
                        },
                        {
                            name: "tds",
                            type: "number",
                            title: "TDS",
                            width: 70
                        },
                        {
                            name: "temp_ambiente",
                            type: "number",
                            title: "Temp Ambiente",
                            width: 100
                        },
                        {
                            name: "temp_solucion",
                            type: "number",
                            title: "Temp Solución",
                            width: 100
                        },
                        {
                            name: "humedad_relativa",
                            type: "number",
                            title: "Humedad Relativa",
                            width: 100
                        },
                        {
                            name: "concentracion_oxigeno",
                            type: "number",
                            title: "Conc. Oxígeno",
                            width: 120
                        },
                        {
                            name: "concentracion_co2",
                            type: "number",
                            title: "Conc. CO2",
                            width: 100
                        },
                        {
                            name: "iluminacion_diaria",
                            type: "number",
                            title: "Iluminación",
                            width: 100
                        },
                        {
                            name: "irrigacion_diaria",
                            type: "number",
                            title: "Irrigación",
                            width: 100
                        },
                        {
                            type: "control",
                            width: 80
                        }
                    ]
                });
            });
        </script>

    </body>

</html>