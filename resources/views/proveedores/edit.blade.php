<div class="modal fade" id="modal-edit-{{$proveedore->persona->id}}" tabindex="-1" role="dialog" aria-labelledby="modal_proveedores_Edit_Title" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered " role="document">
    <div class="modal-content">
      <div class="modal-header colorEdit">
        <h4 class="modal-title" id="modal_proveedores_Edit_LongTitle">{{__('Editar')}} Proveedor</h4>
        <button type="button" class="btn btn-close btn-warning pull-right" data-dismiss="modal" aria-label="Close">X</button>
      </div>
      <form method="POST" action="{{ route('personas.update', $proveedore->persona->id) }}" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        <input type="hidden" name="tipo_persona" value="Proveedor" readonly>
        <input type="hidden" name="id" value="{{ $proveedore->persona->id }}" readonly>
        <div class="modal-body">
            <div class="row">
                <div class="col-lg-6 d-none">
                    <div class="form-group">
                        <label>PERSONA *</label>
                        <select name="idPersona" id="idPersona" class="form-control" readonly>
                            <option value="">{{ __('Seleccionar') }} Persona *</option>
                            @if ($proveedore->persona->estado == false)
                                <option selected value="{{ $proveedore->idPersona }}">{{ $proveedore->persona->razon_social }}</option>
                            @endif
                            @foreach ($personas as $persona)
                                <option {{ old('idPersona', $proveedore->idPersona) == $persona->id ? 'selected' : '' }} 
                                        value="{{ $persona->id }}">{{ $persona->razon_social }}</option>
                            @endforeach
                        </select>
                        @error('idPersona') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="razon_social">RAZON SOCIAL *</label>
                        <input type="text" name="razon_social" class="form-control" value="{{ old('razon_social', $proveedore->persona->razon_social) }}" placeholder="{{ __('Digite aquí') }} Razon Social *..." required pattern="[A-Z\s]+" title="Solo se permiten letras mayúsculas y espacios." oninput="this.value = this.value.toUpperCase();">
                        @error('razon_social') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="tipo_documento">TIPO DOCUMENTO *</label>
                        <select name="tipo_documento" class="form-control" required>
                            <option value="">Seleccionar Tipo de Documento</option>
                            <option value="CI" {{ old('tipo_documento', $proveedore->persona->tipo_documento) == 'CI' ? 'selected' : '' }}>CI</option>
                            <option value="Licencia de conducir" {{ old('tipo_documento', $proveedore->persona->tipo_documento) == 'Licencia de conducir' ? 'selected' : '' }}>Licencia de conducir</option>
                            <option value="NIT" {{ old('tipo_documento', $proveedore->persona->tipo_documento) == 'NIT' ? 'selected' : '' }}>NIT</option>
                            <option value="RUC" {{ old('tipo_documento', $proveedore->persona->tipo_documento) == 'RUC' ? 'selected' : '' }}>RUC</option>
                            <option value="Pasaporte" {{ old('tipo_documento', $proveedore->persona->tipo_documento) == 'Pasaporte' ? 'selected' : '' }}>Pasaporte</option>
                        </select>
                        @error('tipo_documento') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="numero_documento">NUMERO DOCUMENTO *</label>
                        <input type="text" name="numero_documento" class="form-control" value="{{ old('numero_documento', $proveedore->persona->numero_documento) }}" placeholder="{{ __('Digite aquí') }} Numero Documento *..." required pattern="[A-Za-z0-9]+" title="El número de documento debe ser alfanumérico.">
                        @error('numero_documento') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="direccion">DIRECCION *</label>
                        <input type="text" name="direccion" class="form-control" value="{{ old('direccion', $proveedore->persona->direccion) }}" placeholder="{{ __('Digite aquí') }} Direccion *..." oninput="this.value = this.value.toUpperCase();" required>
                        @error('direccion') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="telefono">TELEFONO *</label>
                        <input type="text" name="telefono" class="form-control" value="{{ old('telefono', $proveedore->persona->telefono) }}" placeholder="{{ __('Digite aquí') }} Telefono *..." required pattern="^\+?[0-9\s\-]*$" title="El teléfono solo puede contener números, +, espacios y guiones.">
                        @error('telefono') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="email">EMAIL *</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $proveedore->persona->email) }}" placeholder="{{ __('Digite aquí') }} Email *..." required pattern="^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$" title="El email debe contener letras, números, puntos, guiones altos y bajos.">
                        @error('email') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Estado(*)</label>
                        <select name="estado" class="form-control"  required>
                            <option @if ($proveedore->persona->estado == "1") selected @endif value="1">Activo</option><option @if ($proveedore->persona->estado == "0") selected @endif value="0">Inactivo</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-danger" type="reset">{{ __('Cancelar') }}</button>
            <button class="btn btn-primary" type="submit">{{ __('Guardar') }}</button>
        </div>
    </form>

    </div>
  </div>
</div>