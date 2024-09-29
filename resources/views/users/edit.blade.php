<div class="modal fade" id="modal-edit-{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="modal_users_Edit_Title" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header colorEdit">
        <h4 class="modal-title" id="modal_users_Edit_LongTitle">{{__('Editar')}} Usuario</h4>
        <button type="button" class="btn btn-close btn-warning pull-right" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">X</span>
        </button>
      </div>
      <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PATCH')
      <div class="modal-body">
          <div class="row">
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12"> 
              <div class="form-group">
                  <label for="name">Nombre (*)</label>
                  <input type="text" name="name" id="name" 
                         class="form-control" 
                         value="{{ old('name', strtoupper($user->name)) }}" 
                         placeholder="Nombre (*)..." 
                         required 
                         pattern="^[A-Z\s]+$" 
                         minlength="5" 
                         maxlength="255">
                  <small class="form-text text-muted">
                      Solo se permiten letras mayúsculas y espacios. Mínimo 5 caracteres.
                  </small>
              </div>
          </div>

          <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12"> 
              <div class="form-group">
                  <label for="email">Email (*)</label>
                  <input type="email" name="email" id="email" 
                         class="form-control" 
                         value="{{ old('email', $user->email) }}" 
                         placeholder="Email (*)..." 
                         required 
                         pattern="^[A-Za-z0-9._-]+@[A-Za-z0-9.-]+\.[A-Z|a-z]{2,7}$">
                  <small class="form-text text-muted">
                      Solo se permiten letras, números, puntos, guiones bajos y altos.
                  </small>
              </div>
          </div>

            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
           		<div class="form-group">
	            	<label for="password">Password(*)</label>
	            	<input type="password" name="password" class="form-control" value="{{old('password',$user->password)}}" placeholder="Password(*)..." required>
	            </div>
            </div>
<!-- 
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
           		<div class="form-group">
	            	<label for="remember_token">Remember Token</label>
	            	<input type="text" name="remember_token" class="form-control" value="{{old('remember_token',$user->remember_token)}}" placeholder="Remember Token..." >
	            </div>
            </div> -->

            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                    <label>Rol(*)</label>
                    <select name="idrol" id="idrol{{$user->id}}" class="form-control" required >
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
        <button class="btn btn-danger" type="reset">{{__('Cancelar')}}</button>
        <button class="btn btn-primary" type="submit">{{__('Guardar')}}</button>
      </div>
      </form>
    </div>
  </div>
</div>