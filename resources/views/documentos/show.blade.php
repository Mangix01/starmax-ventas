<!-- documentos show.blade.php    Ver Detalle de Documentos -->
<div class="modal fade" id="modal-ver-{{$documento->id}}" tabindex="-1" role="dialog" aria-labelledby="modal_documentos_Ver_Title" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered " role="document">
    <div class="modal-content">
      <div class="modal-header colorShow">
        <h4 class="modal-title" id="modal_documentos_Ver_LongTitle">{{ __('Detalle de') }} Documento</h4>
        <button type="button" class="btn btn-close btn-info" data-dismiss="modal" aria-label="Close">X</button>
      </div>
      <div class="modal-body">
          <div class="row">
            <div class="col-lg-12">
           		<div class="form-group">
	            	<label for="id">ID *</label>
	            	<input type="number" name="id" class="form-control" value="{{$documento->id}}" disabled>
	            </div>
            </div>
            
            <div class="col-lg-12">
           		<div class="form-group">
	            	<label for="tipo_documento">TIPO DOCUMENTO *</label>
	            	<input type="text" name="tipo_documento" class="form-control" value="{{$documento->tipo_documento}}" disabled>
	            </div>
            </div>
            
            <div class="col-lg-12">
           		<div class="form-group">
	            	<label for="numero_documento">NUMERO DOCUMENTO *</label>
	            	<input type="text" name="numero_documento" class="form-control" value="{{$documento->numero_documento}}" disabled>
	            </div>
            </div>
            
            
          </div>
      </div>
      <div class="modal-footer">
        <a href="#" class="btn btn-danger" data-dismiss="modal" title="Regresar al Listado Anterior">{{__('Volver')}}</a>
      </div>
    </div>
  </div>
</div>