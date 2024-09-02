<!-- auditoria show.blade.php    Ver Detalle de Auditoria -->
<div class="modal fade" id="modal-ver-{{$auditori->id}}" tabindex="-1" role="dialog" aria-labelledby="modal_auditoria_Ver_Title" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered " role="document">
    <div class="modal-content">
      <div class="modal-header colorShow">
        <h4 class="modal-title" id="modal_auditoria_Ver_LongTitle">{{ __('Detalle de') }} Auditoria</h4>
        <button type="button" class="btn btn-close btn-info" data-dismiss="modal" aria-label="Close">X</button>
      </div>
      <div class="modal-body">
          <div class="row">
            <div class="col-lg-12">
           		<div class="form-group">
	            	<label for="operacion">OPERACION *</label>
	            	<input type="text" name="operacion" class="form-control" value="{{$auditori->operacion}}" disabled>
	            </div>
            </div>
            
            <div class="col-lg-12">
           		<div class="form-group">
	            	<label for="notas">NOTAS *</label>
	            	<input type="text" name="notas" class="form-control" value="{{$auditori->notas}}" disabled>
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