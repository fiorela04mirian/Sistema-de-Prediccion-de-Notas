@extends('layouts.app')

@section('template_title')
    {{ $parametro->name ?? __('Show') . " " . __('Parametro') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Parametro</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('parametros.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Fecha:</strong>
                                    {{ $parametro->fecha }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Hora:</strong>
                                    {{ $parametro->hora }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Ce:</strong>
                                    {{ $parametro->ce }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Ph:</strong>
                                    {{ $parametro->ph }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Temp Ambiente:</strong>
                                    {{ $parametro->temp_ambiente }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Temp Solucion:</strong>
                                    {{ $parametro->temp_solucion }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
