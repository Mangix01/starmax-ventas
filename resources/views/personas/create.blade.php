<div class="modal fade" id="modal_Personas_Create" tabindex="-1" role="dialog" aria-labelledby="modal_Personas_Create_Title" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header colorCreate">
        <h4 class="modal-title" id="modal_Personas_Create_LongTitle">{{__('Nuevo')}} Persona</h4>
        <button type="button" class="btn btn-close btn-success pull-right" data-dismiss="modal" aria-label="Close">X</button>
      </div>
      <form action="{{ url('personas') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group">
                    <label>TIPO PERSONA(*)</label>
                    <select name="tipo_persona" id="tipo_persona" class="form-control" required>
                        <option value="">{{ __('Seleccionar') }} Tipo Persona</option>
                        <option {{ old('tipo_persona' ) == 'Cliente'  ? 'selected' : '' }} value="Cliente">Cliente</option>
                        <option {{ old('tipo_persona' ) == 'Proveedor'  ? 'selected' : '' }} value="Proveedor">Proveedor</option>
                        
                    </select>
                </div>
              </div>
              <div class="col-lg-6"> 
                <div class="form-group">
                	<label for="razon_social">RAZON SOCIAL *</label>
                	<input type="text" name="razon_social"  class="form-control" value="{{ old('razon_social') }}" placeholder="{{__('Digite aquí') }} Razon Social *..." required>
                  @error('razon_social') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
                </div>
              </div>
              
              <div class="col-lg-6"> 
                <div class="form-group">
                	<label for="tipo_documento">TIPO DOCUMENTO *</label>
                	<input type="text" name="tipo_documento"  class="form-control" value="{{ old('tipo_documento') }}" placeholder="{{__('Digite aquí') }} Tipo Documento *..." required>
                  @error('tipo_documento') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
                </div>
              </div>
              
              <div class="col-lg-6"> 
                <div class="form-group">
                	<label for="numero_documento">NUMERO DOCUMENTO *</label>
                	<input type="text" name="numero_documento"  class="form-control" value="{{ old('numero_documento') }}" placeholder="{{__('Digite aquí') }} Numero Documento *..." required>
                  @error('numero_documento') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
                </div>
              </div>
              
              <div class="col-lg-6"> 
                <div class="form-group">
                	<label for="direccion">DIRECCION *</label>
                	<input type="text" name="direccion"  class="form-control" value="{{ old('direccion') }}" placeholder="{{__('Digite aquí') }} Direccion *..." required>
                  @error('direccion') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
                </div>
              </div>
              
              <div class="col-lg-6"> 
                <div class="form-group">
                	<label for="telefono">TELEFONO *</label>
                	<input type="text" name="telefono"  class="form-control" value="{{ old('telefono') }}" placeholder="{{__('Digite aquí') }} Telefono *..." required>
                  @error('telefono') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
                </div>
              </div>
              
              <div class="col-lg-6"> 
                <div class="form-group">
                	<label for="email">EMAIL *</label>
                	<input type="email" name="email"  class="form-control" value="{{ old('email') }}" placeholder="{{__('Digite aquí') }} Email *..." required>
                  @error('email') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
                </div>
              </div>
              
              <div class="col-lg-6 d-none">
                <div class="form-group">
                    <label>Estado(*)</label>
                    <select name="estado" class="form-control"  required>
                        <option value="1">Activo</option><option value="0">Inactivo</option>
                    </select>
                </div>
            </div>
            </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-danger" type="reset">{{__('Cancelar')}}</button>
          <button class="btn btn-primary" type="submit">{{__('Guardar')}}</button>
        </div>
      </form>
    </div>
  </div>
</div>