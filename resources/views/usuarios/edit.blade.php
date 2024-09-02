<div class="modal fade" id="modal-edit-{{$usuario->id}}" tabindex="-1" role="dialog" aria-labelledby="modal_usuarios_Edit_Title" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered " role="document">
    <div class="modal-content">
      <div class="modal-header colorEdit">
        <h4 class="modal-title" id="modal_usuarios_Edit_LongTitle">{{__('Editar')}} Usuario</h4>
        <button type="button" class="btn btn-close btn-warning pull-right" data-dismiss="modal" aria-label="Close">X</button>
      </div>
      <form method="POST" action="{{ route('usuarios.update', $usuario->id) }}" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        <input type="hidden" name="id" value="{{$usuario->id}}" readonly>
        <div class="modal-body">
            <div class="row">
              <div class="col-lg-12">
             		<div class="form-group">
  	            	<label for="nombre">NOMBRE *</label>
  	            	<input type="text" name="nombre" class="form-control" value="{{old('nombre',$usuario->nombre)}}" placeholder="{{__('Digite aquí') }} Nombre *..." required>
                  @error('nombre') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
  	            </div>
              </div>
              
              <div class="col-lg-12">
             		<div class="form-group">
  	            	<label for="nombre_usuario">NOMBRE USUARIO *</label>
  	            	<input type="text" name="nombre_usuario" class="form-control" value="{{old('nombre_usuario',$usuario->nombre_usuario)}}" placeholder="{{__('Digite aquí') }} Nombre Usuario *..." required>
                  @error('nombre_usuario') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
  	            </div>
              </div>
              
              <div class="col-lg-12">
             		<div class="form-group">
  	            	<label for="password">PASSWORD *</label>
  	            	<input type="text" name="password" class="form-control" value="{{old('password',$usuario->password)}}" placeholder="{{__('Digite aquí') }} Password *..." required>
                  @error('password') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
  	            </div>
              </div>
              
              <div class="col-lg-12">
             		<div class="form-group">
  	            	<label for="email">EMAIL *</label>
  	            	<input type="email" name="email" class="form-control" value="{{old('email',$usuario->email)}}" placeholder="{{__('Digite aquí') }} Email *..." required>
                  @error('email') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
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