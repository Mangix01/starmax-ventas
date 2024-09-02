<!-- users show.blade.php    Ver Detalle de Users -->
<div class="modal fade" id="modal-ver-{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="modal_users_Ver_Title" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header colorShow">
        <h4 class="modal-title" id="modal_users_Ver_LongTitle">Detalle de Usuario</h4>
        <button type="button" class="btn btn-close btn-info pull-right" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">X</span>
        </button>
      </div>
      
      <div class="modal-body">
          <div class="row">
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
           		<div class="form-group">
	            	<label for="name">Nombre(*)</label>
	            	<input type="text" name="name" class="form-control" value="{{$user->name}}" disabled>
	            </div>
            </div>

            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
           		<div class="form-group">
	            	<label for="email">Email(*)</label>
	            	<input type="email" name="email" class="form-control" value="{{$user->email}}" disabled>
	            </div>
            </div>

<!--             <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
           		<div class="form-group">
	            	<label for="password">Password(*)</label>
	            	<input type="text" name="password" class="form-control" value="{{$user->password}}" disabled>
	            </div>
            </div>

            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
           		<div class="form-group">
	            	<label for="remember_token">Remember Token</label>
	            	<input type="text" name="remember_token" class="form-control" value="{{$user->remember_token}}" disabled>
	            </div>
            </div> -->
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                    <label>Rol(*)</label>
                    <select name="idrol" id="idrol" class="form-control" disabled ">
                        <option value="">Seleccionar</option>
                        @foreach ($roles as $rol)
                            <option 
                                {{ old('idrol',$user->rol_id) == $rol->id ? 'selected' : '' }}
                                value="{{$rol->id}}">{{$rol->name}}
                            </option>
                        @endforeach
                    </select>
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