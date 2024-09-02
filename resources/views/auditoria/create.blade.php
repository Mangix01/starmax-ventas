<div class="modal fade" id="modal_Auditoria_Create" tabindex="-1" role="dialog" aria-labelledby="modal_Auditoria_Create_Title" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered " role="document">
    <div class="modal-content">
      <div class="modal-header colorCreate">
        <h4 class="modal-title" id="modal_Auditoria_Create_LongTitle">{{__('Nuevo')}} Auditoria</h4>
        <button type="button" class="btn btn-close btn-success pull-right" data-dismiss="modal" aria-label="Close">X</button>
      </div>
      <form action="{{ url('auditoria') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
            <div class="row">
              <div class="col-lg-12"> 
                <div class="form-group">
                	<label for="operacion">OPERACION *</label>
                	<input type="text" name="operacion"  class="form-control" value="{{ old('operacion') }}" placeholder="{{__('Digite aquí') }} Operacion *..." required>
                  @error('operacion') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
                </div>
              </div>
              
              <div class="col-lg-12"> 
                <div class="form-group">
                	<label for="notas">NOTAS *</label>
                	<input type="text" name="notas"  class="form-control" value="{{ old('notas') }}" placeholder="{{__('Digite aquí') }} Notas *..." required>
                  @error('notas') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
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