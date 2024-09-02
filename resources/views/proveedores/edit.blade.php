<div class="modal fade" id="modal-edit-{{$proveedore->id}}" tabindex="-1" role="dialog" aria-labelledby="modal_proveedores_Edit_Title" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered " role="document">
    <div class="modal-content">
      <div class="modal-header colorEdit">
        <h4 class="modal-title" id="modal_proveedores_Edit_LongTitle">{{__('Editar')}} Proveedore</h4>
        <button type="button" class="btn btn-close btn-warning pull-right" data-dismiss="modal" aria-label="Close">X</button>
      </div>
      <form method="POST" action="{{ route('proveedores.update', $proveedore->id) }}" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        <input type="hidden" name="id" value="{{$proveedore->id}}" readonly>
        <div class="modal-body">
            <div class="row">
              <div class="col-lg-12">
								<div class="form-group">
									<label>PERSONA *</label>
									<select name="idPersona" id="idPersona" class="form-control" required>
										<option value="">{{ __('Seleccionar') }} Persona *</option>
										@if($proveedore->persona->estado==false)
                		<option selected value={{$proveedore->idPersona}}>{{$proveedore->persona->razon_social}}</option>
           	 				@endif
										@foreach ($personas as $persona)
											<option {{ old('idPersona',$proveedore->idPersona) == $persona->id ? 'selected' : '' }} 
											value="{{$persona->id}}">{{ $persona->razon_social }}
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