<div class="modal fade" id="modal_Comprobantes_Create" tabindex="-1" role="dialog" aria-labelledby="modal_Comprobantes_Create_Title" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered " role="document">
    <div class="modal-content">
      <div class="modal-header colorCreate">
        <h4 class="modal-title" id="modal_Comprobantes_Create_LongTitle">{{__('Nuevo')}} Comprobante</h4>
        <button type="button" class="btn btn-close btn-success pull-right" data-dismiss="modal" aria-label="Close">X</button>
      </div>
      <form action="{{ url('comprobantes') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
            <div class="row">
              <div class="col-lg-12"> 
                <div class="form-group">
                	<label for="tipo_comprobante">TIPO COMPROBANTE *</label>
                	<input type="text" name="tipo_comprobante"  class="form-control" value="{{ old('tipo_comprobante') }}" placeholder="{{__('Digite aquí') }} Tipo Comprobante *..." required>
                  @error('tipo_comprobante') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
                </div>
              </div>
              
              <div class="col-lg-12 d-none">
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