<!-- roles show.blade.php    Ver Detalle de Roles -->
<div class="modal fade" id="modal-ver-{{$role->id}}" tabindex="-1" role="dialog" aria-labelledby="modal_roles_Ver_Title" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header colorShow">
        <h4 class="modal-title" id="modal_roles_Ver_LongTitle">Detalle de Rol</h4>
        <button type="button" class="btn btn-close btn-info pull-right" data-dismiss="modal" aria-label="Close">X</button>
      </div>

      <div class="modal-body">
          <div class="row">
            <div class="col-lg-12">
              <div class="form-group">
                <label for="name">Rol(*)</label>
                <input type="text" name="name" class="form-control" value="{{$role->name}}" disabled>
              </div>
            </div>
            
            <div class="col-lg-12 d-none">
              <div class="form-group">
                <label for="guard_name">Aplicación(*)</label>
                <input type="text" name="guard_name" class="form-control" value="{{$role->guard_name}}" disabled>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="row">
                <div class="col-lg-4">
                  <label></label>
                </div>
                <div class="col-lg-1">
                  <label>Dashboard</label>
                </div>
                <div class="col-lg-1">
                  <label>Listar</label>
                </div>
                <div class="col-lg-1">
                  <label>Crear</label>
                </div>
                <div class="col-lg-1">
                  <label>Editar</label>
                </div>
                <div class="col-lg-1">
                  <label>Ver</label>
                </div>
                <div class="col-lg-1">
                  <label>Eliminar</label>
                </div>
                <div class="col-lg-1">
                  <label>Reportar</label>
                </div>
              </div>
            @foreach($roles2 as $key => $rol2)
            @if($role->name == $rol2['name'] )
            @foreach( $rol2['permisos'] as $key2 => $permisito)
              <div style="display: none"> {{ $permiso = collect($permisito)}} </div>
              <div class="row">
                <div class="col-lg-1">
                  <label></label>
                </div>
                <div class="col-lg-3">
                  <label>{{ str_replace('_',' ',strtoupper($permiso["tabla"])) }}</label>
                </div>
                <div class="col-lg-1">
                  <input type="checkbox" name="dashboard[{{$key2}}]" value="dashboard {{$permiso["tabla"]}}" {{($permiso["dashboard"]==1) ? 'checked' : ''}} disabled>
                </div>
                <div class="col-lg-1">
                  <input type="checkbox" name="listar[{{$key2}}]" value="index {{$permiso["tabla"]}}" {{($permiso["listar"]==1) ? 'checked' : ''}} disabled>
                </div>
                <div class="col-lg-1">
                  <input type="checkbox" name="crear[{{$key2}}]" value="create {{$permiso["tabla"]}}" {{($permiso["crear"]==1) ? 'checked' : ''}} disabled>
                </div>
                <div class="col-lg-1">
                  <input type="checkbox" name="editar[{{$key2}}]" value="edit {{$permiso["tabla"]}}" {{($permiso["editar"]==1) ? 'checked' : ''}} disabled>
                </div>
                <div class="col-lg-1">
                  <input type="checkbox" name="ver[{{$key2}}]" value="show {{$permiso["tabla"]}}" {{($permiso["ver"]==1) ? 'checked' : ''}} disabled>
                </div>
                <div class="col-lg-1">
                  <input type="checkbox" name="eliminar[{{$key2}}]" value="destroy {{$permiso["tabla"]}}" {{($permiso["eliminar"]==1) ? 'checked' : ''}} disabled>
                </div>
                <div class="col-lg-1">
                  <input type="checkbox" name="reportar[{{$key2}}]" value="report {{$permiso["tabla"]}}" {{($permiso["reportar"]==1) ? 'checked' : ''}} disabled>
                </div>
              </div>
            @endforeach
            @endif
            @endforeach
          </div>
      </div>
      <div class="modal-footer">
        <a href="#" class="btn btn-danger" data-dismiss="modal" title="Regresar al Listado Anterior">{{__('Volver')}}</a>
      </div>

    </div>
  </div>
</div>