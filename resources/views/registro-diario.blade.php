@extends('layouts.app') <!-- Extiende del layout principal -->

@section('title', 'Registro Diario') <!-- Título dinámico -->

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Registro Diario</h4>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Planta A</td>
                    <td>2025-03-20</td>
                    <td>Activa</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Planta B</td>
                    <td>2025-03-21</td>
                    <td>Inactiva</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
