<div class="modal fade" id="modal-edit-{{$permission->id}}" tabindex="-1" role="dialog" aria-labelledby="modal_permissions_Edit_Title" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered " role="document">
    <div class="modal-content">
      <div class="modal-header colorEdit">
        <h4 class="modal-title" id="modal_permissions_Edit_LongTitle">{{__('Editar')}} Permission</h4>
        <button type="button" class="btn btn-close btn-warning pull-right" data-dismiss="modal" aria-label="Close">X</button>
      </div>
      <form method="POST" action="{{ route('permissions.update', $permission->id) }}" method="PATCH" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        <input type="hidden" name="id" value="{{$permission->id}}" readonly>
        <div class="modal-body">
            <div class="row">
              <div class="col-lg-12">
             		<div class="form-group">
  	            	<label for="name">NAME *</label>
  	            	<input type="text" name="name" class="form-control" value="{{old('name',$permission->name)}}" placeholder="{{__('Digite aquí') }} Name..." required>
                  @error('name') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
  	            </div>
              </div>
              
              <div class="col-lg-12 d-none">
             		<div class="form-group">
  	            	<label for="guard_name">GUARD NAME *</label>
  	            	<input type="text" name="guard_name" class="form-control" value="{{old('guard_name',$permission->guard_name)}}" placeholder="{{__('Digite aquí') }} Guard_name..." readonly>
                  @error('guard_name') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
  	            </div>
              </div>
              
              <div class="col-lg-12">
             		<div class="form-group">
  	            	<label for="tabla">TABLA *</label>
  	            	<input type="text" name="tabla" class="form-control" value="{{old('tabla',$permission->tabla)}}" placeholder="{{__('Digite aquí') }} Tabla..." required>
                  @error('tabla') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
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