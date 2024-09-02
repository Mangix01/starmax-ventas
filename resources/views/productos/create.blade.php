<div class="modal fade" id="modal_Productos_Create" tabindex="-1" role="dialog" aria-labelledby="modal_Productos_Create_Title" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header colorCreate">
        <h4 class="modal-title" id="modal_Productos_Create_LongTitle">{{__('Nuevo')}} Producto</h4>
        <button type="button" class="btn btn-close btn-success pull-right" data-dismiss="modal" aria-label="Close">X</button>
      </div>
      <form action="{{ url('productos') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
            <div class="row">
              <div class="col-lg-6">
								<div class="form-group">
									<label>CATEGORIA *</label>
									<select name="idCategoria" id="idCategoria" class="form-control" required>
										<option value="">{{ __('Seleccionar') }} Categoria *</option>
											@foreach ($categorias as $categoria)
											<option {{ old('idCategoria') == $categoria->id ? 'selected' : '' }} 
													value="{{$categoria->id}}">{{ $categoria->categoria }}</option>
											@endforeach
									</select>
								</div>
							</div>
							<div class="col-lg-6"> 
                <div class="form-group">
                	<label for="codigo">CODIGO</label>
                	<input type="text" name="codigo"  class="form-control" value="{{ old('codigo') }}" placeholder="{{__('Digite aquí') }} Codigo..." >
                  @error('codigo') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
                </div>
              </div>
              
              <div class="col-lg-6"> 
                <div class="form-group">
                	<label for="nombre">NOMBRE *</label>
                	<input type="text" name="nombre"  class="form-control" value="{{ old('nombre') }}" placeholder="{{__('Digite aquí') }} Nombre *..." required>
                  @error('nombre') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
                </div>
              </div>
              
              <div class="col-lg-6"> 
                <div class="form-group">
                	<label for="stock">STOCK *</label>
                	<input type="number" name="stock"  class="form-control" value="{{ old('stock') }}" placeholder="{{__('Digite aquí') }} Stock *..." required>
                  @error('stock') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
                </div>
              </div>
              
              <div class="col-lg-6"> 
                <div class="form-group">
                	<label for="marca">MARCA *</label>
                	<input type="text" name="marca"  class="form-control" value="{{ old('marca') }}" placeholder="{{__('Digite aquí') }} Marca *..." required>
                  @error('marca') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
                </div>
              </div>
              
              <div class="col-lg-6"> 
                <div class="form-group">
                	<label for="descripcion">DESCRIPCION</label>
                	<input type="text" name="descripcion"  class="form-control" value="{{ old('descripcion') }}" placeholder="{{__('Digite aquí') }} Descripcion..." >
                  @error('descripcion') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
                </div>
              </div>
              
              <div class="col-lg-6"> 
                <div class="form-group">
                	<label for="precio">PRECIO *</label>
                	<input type="decimal" name="precio"  class="form-control" value="{{ old('precio') }}" placeholder="{{__('Digite aquí') }} Precio *..." required>
                  @error('precio') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
                </div>
              </div>
              
              <div class="col-lg-6"> 
                <div class="form-group">
                	<label for="imagen">IMAGEN</label>
                	<input type="file" name="imagen"  class="form-control" value="{{ old('imagen') }}" placeholder="{{__('Digite aquí') }} Imagen..." id="imagen" accept="image/*" onchange="colocarFoto('imagen','.img-thumbnail');" >
                  @error('imagen') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
                </div>
              </div>
              
              <div  class="text-center">    
                <img src="" alt="Sin imagen" 
                    width="250px" class="img-thumbnail">
                <a href="javascript:void(0);"onclick="limpiarFoto('imagen','.img-thumbnail');">
                    <span class="badge badge-danger">X</span>
                </a>
              </div>
              <div class="col-lg-6 d-none">
                <div class="form-group">
                    <label>Estado(*)</label>
                    <select name="estado" class="form-control"  required>
                        <option value="1">Activo</option><option value="0">Inactivo</option>
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