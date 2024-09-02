<!-- productos show.blade.php    Ver Detalle de Productos -->
<div class="modal fade" id="modal-ver-{{$producto->id}}" tabindex="-1" role="dialog" aria-labelledby="modal_productos_Ver_Title" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header colorShow">
        <h4 class="modal-title" id="modal_productos_Ver_LongTitle">{{ __('Detalle de') }} Producto</h4>
        <button type="button" class="btn btn-close btn-info" data-dismiss="modal" aria-label="Close">X</button>
      </div>
      <div class="modal-body">
          <div class="row">
            <div class="col-lg-6">
           		<div class="form-group">
	            	<label for="idCategoria">CATEGORIA *</label>
	            	<input type="text" name="idCategoria" class="form-control" value="{{$producto->categoria->categoria}}" disabled>
	            </div>
            </div>
            
            <div class="col-lg-6">
           		<div class="form-group">
	            	<label for="codigo">CODIGO</label>
	            	<input type="text" name="codigo" class="form-control" value="{{$producto->codigo}}" disabled>
	            </div>
            </div>
            
            <div class="col-lg-6">
           		<div class="form-group">
	            	<label for="nombre">NOMBRE *</label>
	            	<input type="text" name="nombre" class="form-control" value="{{$producto->nombre}}" disabled>
	            </div>
            </div>
            
            <div class="col-lg-6">
           		<div class="form-group">
	            	<label for="stock">STOCK *</label>
	            	<input type="number" name="stock" class="form-control" value="{{$producto->stock}}" disabled>
	            </div>
            </div>
            
            <div class="col-lg-6">
           		<div class="form-group">
	            	<label for="marca">MARCA *</label>
	            	<input type="text" name="marca" class="form-control" value="{{$producto->marca}}" disabled>
	            </div>
            </div>
            
            <div class="col-lg-6">
           		<div class="form-group">
	            	<label for="descripcion">DESCRIPCION</label>
	            	<input type="text" name="descripcion" class="form-control" value="{{$producto->descripcion}}" disabled>
	            </div>
            </div>
            
            <div class="col-lg-6">
           		<div class="form-group">
	            	<label for="precio">PRECIO *</label>
	            	<input type="decimal" name="precio" class="form-control" value="{{$producto->precio}}" disabled>
	            </div>
            </div>
            
            <div class="col-lg-6">
           		<div class="form-group">
	            	<label for="imagen">IMAGEN</label>
	            	<input type="file" name="imagen" class="form-control" value="{{$producto->imagen}}" disabled>
	            </div>
            </div>
            
            <div>    
                <img src="{{Storage::url($producto->imagen)}}" alt="Sin imagen" width="250px" >
            </div>
            <div class="col-lg-6">
           		<div class="form-group">
	            	<label for="estado">ESTADO *</label>
	            	<input type="checkbox" name="estado"  value="{{$producto->estado}}" @if($producto->estado) checked @endif disabled>
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