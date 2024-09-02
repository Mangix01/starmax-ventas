<!-- proveedores show.blade.php    Ver Detalle de Proveedores -->
<div class="modal fade" id="modal-ver-{{$proveedore->id}}" tabindex="-1" role="dialog" aria-labelledby="modal_proveedores_Ver_Title" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered " role="document">
    <div class="modal-content">
      <div class="modal-header colorShow">
        <h4 class="modal-title" id="modal_proveedores_Ver_LongTitle">Detalle del Proveedor</h4>
        <button type="button" class="btn btn-close btn-info" data-dismiss="modal" aria-label="Close">X</button>
      </div>

      <div class="modal-body">
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label for="tipo_persona">TIPO PERSONA *</label>
                <input type="text" name="tipo_persona" class="form-control" value="{{$proveedore->persona->tipo_persona}}" disabled>
              </div>
            </div>
            
            <div class="col-lg-6">
              <div class="form-group">
                <label for="razon_social">RAZON SOCIAL *</label>
                <input type="text" name="razon_social" class="form-control" value="{{$proveedore->persona->razon_social}}" disabled>
              </div>
            </div>
            
            <div class="col-lg-6">
              <div class="form-group">
                <label for="tipo_documento">TIPO DOCUMENTO *</label>
                <input type="text" name="tipo_documento" class="form-control" value="{{$proveedore->persona->tipo_documento}}" disabled>
              </div>
            </div>
            
            <div class="col-lg-6">
              <div class="form-group">
                <label for="numero_documento">NUMERO DOCUMENTO *</label>
                <input type="text" name="numero_documento" class="form-control" value="{{$proveedore->persona->numero_documento}}" disabled>
              </div>
            </div>
            
            <div class="col-lg-6">
              <div class="form-group">
                <label for="direccion">DIRECCION *</label>
                <input type="text" name="direccion" class="form-control" value="{{$proveedore->persona->direccion}}" disabled>
              </div>
            </div>
            
            <div class="col-lg-6">
              <div class="form-group">
                <label for="telefono">TELEFONO *</label>
                <input type="text" name="telefono" class="form-control" value="{{$proveedore->persona->telefono}}" disabled>
              </div>
            </div>
            
            <div class="col-lg-6">
              <div class="form-group">
                <label for="email">EMAIL *</label>
                <input type="email" name="email" class="form-control" value="{{$proveedore->persona->email}}" disabled>
              </div>
            </div>
            
            <div class="col-lg-6">
              <div class="form-group">
                <label for="estado">ESTADO *</label>
                <input type="checkbox" name="estado"  value="{{$proveedore->persona->estado}}" @if($proveedore->persona->estado) checked @endif disabled>
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