<div class="modal fade" id="createParametroModal" tabindex="-1" role="dialog" aria-labelledby="createParametroModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="createParametroModalLabel">{{ __('Create New Parámetro') }}</h4>
                <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Formulario -->
                <form action="{{ route('parametros.store') }}" method="POST">
                    @csrf
                    <div class="row p-1">
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label for="fecha" class="form-label">{{ __('Fecha') }}</label>
                                <input type="date" name="fecha" class="form-control @error('fecha') is-invalid @enderror" 
                                    value="{{ old('fecha') }}" id="fecha" placeholder="Fecha">
                                {!! $errors->first('fecha', '<div class="invalid-feedback"><strong>:message</strong></div>') !!}
                            </div>

                        </div>

                        <div class="col-md-12 mt-3 text-end">
                            <button type="submit" class="btn btn-primary">{{ __('Guardar Parámetro') }}</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cerrar') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>