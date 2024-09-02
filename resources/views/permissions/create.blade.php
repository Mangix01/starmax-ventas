<div class="modal fade" id="modal_Permissions_Create" tabindex="-1" role="dialog" aria-labelledby="modal_Permissions_Create_Title" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered " role="document">
    <div class="modal-content">
      <div class="modal-header colorCreate">
        <h4 class="modal-title" id="modal_Permissions_Create_LongTitle">{{__('Nuevo')}} Permission</h4>
        <button type="button" class="btn btn-close btn-success pull-right" data-dismiss="modal" aria-label="Close">X</button>
      </div>
      <form action="{{ url('permissions') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
            <div class="row">
              <div class="col-lg-12"> 
                <div class="form-group">
                	<label for="name">NAME *</label>
                	<input type="text" name="name"  class="form-control" value="{{ old('name') }}" placeholder="{{__('Digite aquí') }} NAME *..." required>
                  @error('name') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
                </div>
              </div>
              
              <div class="col-lg-12 d-none"> 
                <div class="form-group">
                	<label for="guard_name">GUARD NAME *</label>
                	<input type="text" name="guard_name"  class="form-control" value="{{ old('guard_name','web') }}" placeholder="{{__('Digite aquí') }} GUARD NAME *..." readonly>
                  @error('guard_name') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
                </div>
              </div>
              
              <div class="col-lg-12"> 
                <div class="form-group">
                	<label for="tabla">TABLA *</label>
                	<input type="text" name="tabla"  class="form-control" value="{{ old('tabla') }}" placeholder="{{__('Digite aquí') }} TABLA *..." required>
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