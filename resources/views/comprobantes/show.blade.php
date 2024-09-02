<!-- comprobantes show.blade.php    Ver Detalle de Comprobantes -->
<div class="modal fade" id="modal-ver-{{$comprobante->id}}" tabindex="-1" role="dialog" aria-labelledby="modal_comprobantes_Ver_Title" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered " role="document">
    <div class="modal-content">
      <div class="modal-header colorShow">
        <h4 class="modal-title" id="modal_comprobantes_Ver_LongTitle">{{ __('Detalle de') }} Comprobante</h4>
        <button type="button" class="btn btn-close btn-info" data-dismiss="modal" aria-label="Close">X</button>
      </div>
      <div class="modal-body">
          <div class="row">
            <div class="col-lg-12">
           		<div class="form-group">
	            	<label for="tipo_comprobante">TIPO COMPROBANTE *</label>
	            	<input type="text" name="tipo_comprobante" class="form-control" value="{{$comprobante->tipo_comprobante}}" disabled>
	            </div>
            </div>
            
            <div class="col-lg-12">
           		<div class="form-group">
	            	<label for="estado">ESTADO *</label>
	            	<input type="checkbox" name="estado"  value="{{$comprobante->estado}}" @if($comprobante->estado) checked @endif disabled>
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