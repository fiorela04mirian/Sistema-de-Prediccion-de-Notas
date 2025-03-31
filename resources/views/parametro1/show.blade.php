@extends('layouts.app')

@section('template_title')
    {{ $parametro->name ?? __('Show') . " " . __('Parametro') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span class="card-title">{{ __('Show') }} Parametro</span>
                        <a class="btn btn-primary btn-sm" href="{{ route('parametros.index') }}"> {{ __('Back') }}</a>
                    </div>

                    <div class="card-body bg-white">
                        <div class="form-group">
                            <strong>Fecha:</strong> {{ $parametro->fecha }}
                        </div>
                        <div class="form-group">
                            <strong>Hora:</strong> {{ $parametro->hora }}
                        </div>
                        <div class="form-group">
                            <strong>Ph:</strong> {{ $parametro->ph }}
                        </div>
                        <div class="form-group">
                            <strong>Ce:</strong> {{ $parametro->ce }}
                        </div>
                        <div class="form-group">
                            <strong>Tds:</strong> {{ $parametro->tds }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
