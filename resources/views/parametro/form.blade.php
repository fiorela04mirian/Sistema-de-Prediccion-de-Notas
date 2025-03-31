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

                            <div class="form-group mb-3">
                                <label for="hora" class="form-label">{{ __('Hora') }}</label>
                                <input type="time" name="hora" class="form-control @error('hora') is-invalid @enderror" 
                                    value="{{ old('hora') }}" id="hora" placeholder="Hora">
                                {!! $errors->first('hora', '<div class="invalid-feedback"><strong>:message</strong></div>') !!}
                            </div>

                            <div class="form-group mb-3">
                                <label for="ce" class="form-label">{{ __('CE (Conductividad Eléctrica en dS/m)') }}</label>
                                <input type="number" step="0.01" name="ce" class="form-control @error('ce') is-invalid @enderror" 
                                    value="{{ old('ce') }}" id="ce" placeholder="CE">
                                {!! $errors->first('ce', '<div class="invalid-feedback"><strong>:message</strong></div>') !!}
                            </div>

                            <div class="form-group mb-3">
                                <label for="ph" class="form-label">{{ __('pH de la Solución Nutritiva') }}</label>
                                <input type="number" step="0.01" name="ph" class="form-control @error('ph') is-invalid @enderror" 
                                    value="{{ old('ph') }}" id="ph" placeholder="pH">
                                {!! $errors->first('ph', '<div class="invalid-feedback"><strong>:message</strong></div>') !!}
                            </div>

                            <div class="form-group mb-3">
                                <label for="temp_ambiente" class="form-label">{{ __('Temperatura Ambiental (°C)') }}</label>
                                <input type="number" step="0.1" name="temp_ambiente" class="form-control @error('temp_ambiente') is-invalid @enderror" 
                                    value="{{ old('temp_ambiente') }}" id="temp_ambiente" placeholder="Temperatura Ambiental">
                                {!! $errors->first('temp_ambiente', '<div class="invalid-feedback"><strong>:message</strong></div>') !!}
                            </div>

                            <div class="form-group mb-3">
                                <label for="temp_solucion" class="form-label">{{ __('Temperatura de la Solución Nutritiva (°C)') }}</label>
                                <input type="number" step="0.1" name="temp_solucion" class="form-control @error('temp_solucion') is-invalid @enderror" 
                                    value="{{ old('temp_solucion') }}" id="temp_solucion" placeholder="Temperatura Solución">
                                {!! $errors->first('temp_solucion', '<div class="invalid-feedback"><strong>:message</strong></div>') !!}
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