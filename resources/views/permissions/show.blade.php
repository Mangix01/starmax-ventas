<!-- permissions show.blade.php    Ver Detalle de Permissions -->
<div class="modal fade" id="modal-ver-{{$permission->id}}" tabindex="-1" role="dialog" aria-labelledby="modal_permissions_Ver_Title" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered " role="document">
    <div class="modal-content">
      <div class="modal-header colorShow">
        <h4 class="modal-title" id="modal_permissions_Ver_LongTitle">{{ __('Detalle de') }} Permission</h4>
        <button type="button" class="btn btn-close btn-info" data-dismiss="modal" aria-label="Close">X</button>
      </div>
      <div class="modal-body">
          <div class="row">
            <div class="col-lg-12">
           		<div class="form-group">
	            	<label for="name">NAME *</label>
	            	<input type="text" name="name" class="form-control" value="{{$permission->name}}" disabled>
	            </div>
            </div>
            
            <div class="col-lg-12 d-none">
           		<div class="form-group">
	            	<label for="guard_name">GUARD NAME *</label>
	            	<input type="text" name="guard_name" class="form-control" value="{{$permission->guard_name}}" disabled>
	            </div>
            </div>
            
            <div class="col-lg-12">
           		<div class="form-group">
	            	<label for="tabla">TABLA *</label>
	            	<input type="text" name="tabla" class="form-control" value="{{$permission->tabla}}" disabled>
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