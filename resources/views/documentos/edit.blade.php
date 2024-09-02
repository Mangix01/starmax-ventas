<div class="modal fade" id="modal-edit-{{$documento->id}}" tabindex="-1" role="dialog" aria-labelledby="modal_documentos_Edit_Title" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered " role="document">
    <div class="modal-content">
      <div class="modal-header colorEdit">
        <h4 class="modal-title" id="modal_documentos_Edit_LongTitle">{{__('Editar')}} Documento</h4>
        <button type="button" class="btn btn-close btn-warning pull-right" data-dismiss="modal" aria-label="Close">X</button>
      </div>
      <form method="POST" action="{{ route('documentos.update', $documento->id) }}" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        <input type="hidden" name="id" value="{{$documento->id}}" readonly>
        <div class="modal-body">
            <div class="row">
              <div class="col-lg-12">
             		<div class="form-group">
  	            	<label for="id">ID *</label>
  	            	<input type="number" name="id" class="form-control" value="{{old('id',$documento->id)}}" placeholder="{{__('Digite aquí') }} Id *..." required>
                  @error('id') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
  	            </div>
              </div>
              
              <div class="col-lg-12">
             		<div class="form-group">
  	            	<label for="tipo_documento">TIPO DOCUMENTO *</label>
  	            	<input type="text" name="tipo_documento" class="form-control" value="{{old('tipo_documento',$documento->tipo_documento)}}" placeholder="{{__('Digite aquí') }} Tipo Documento *..." required>
                  @error('tipo_documento') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
  	            </div>
              </div>
              
              <div class="col-lg-12">
             		<div class="form-group">
  	            	<label for="numero_documento">NUMERO DOCUMENTO *</label>
  	            	<input type="text" name="numero_documento" class="form-control" value="{{old('numero_documento',$documento->numero_documento)}}" placeholder="{{__('Digite aquí') }} Numero Documento *..." required>
                  @error('numero_documento') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
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