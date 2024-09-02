<!-- usuarios show.blade.php    Ver Detalle de Usuarios -->
<div class="modal fade" id="modal-ver-{{$usuario->id}}" tabindex="-1" role="dialog" aria-labelledby="modal_usuarios_Ver_Title" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered " role="document">
    <div class="modal-content">
      <div class="modal-header colorShow">
        <h4 class="modal-title" id="modal_usuarios_Ver_LongTitle">{{ __('Detalle de') }} Usuario</h4>
        <button type="button" class="btn btn-close btn-info" data-dismiss="modal" aria-label="Close">X</button>
      </div>
      <div class="modal-body">
          <div class="row">
            <div class="col-lg-12">
           		<div class="form-group">
	            	<label for="nombre">NOMBRE *</label>
	            	<input type="text" name="nombre" class="form-control" value="{{$usuario->nombre}}" disabled>
	            </div>
            </div>
            
            <div class="col-lg-12">
           		<div class="form-group">
	            	<label for="nombre_usuario">NOMBRE USUARIO *</label>
	            	<input type="text" name="nombre_usuario" class="form-control" value="{{$usuario->nombre_usuario}}" disabled>
	            </div>
            </div>
            
            <div class="col-lg-12">
           		<div class="form-group">
	            	<label for="password">PASSWORD *</label>
	            	<input type="text" name="password" class="form-control" value="{{$usuario->password}}" disabled>
	            </div>
            </div>
            
            <div class="col-lg-12">
           		<div class="form-group">
	            	<label for="email">EMAIL *</label>
	            	<input type="email" name="email" class="form-control" value="{{$usuario->email}}" disabled>
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