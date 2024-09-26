<div class="modal fade" id="modal_Roles_Create" tabindex="-1" role="dialog" aria-labelledby="modal_Roles_Create_Title" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header colorCreate">
        <h4 class="modal-title" id="modal_Roles_Create_LongTitle">{{__('Nuevo')}} Rol </h4>
        <button type="button" class="btn btn-close btn-success pull-right" data-dismiss="modal" aria-label="Close">X</button>
      </div>
      <form action="{{ url('roles') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="row">
          <div class="col-lg-12">
            <div class="form-group">
              <label for="name">Rol(*)</label>
              <input type="text" name="name" class="form-control" placeholder="Ingrese aquí Rol(*)..." required pattern="[A-Za-z0-9\s]+"
                    title="Solo se permiten letras y números">
            </div>
            </div>

            <div class="col-lg-12 d-none">
              <div class="form-group">
                <label for="guard_name">Aplicación(*)</label>
                <input type="text" name="guard_name" class="form-control" placeholder="Ingrese aquí Aplicación(*)..." value="web" readonly>
              </div>
            </div>
          </div>

          <div class="card">
            <div class="row">
              <div class="col-lg-3">
                <label></label>
              </div>
              <div class="col-lg-1">
                <label>Todo</label>
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
              @if($key == 1)
                @foreach($rol2['permisos'] as $key2 => $permisito)
                  @php $permiso = collect($permisito); @endphp
                  <div class="row">
                    <div class="col-lg-3">
                      <label>{{ str_replace('_', ' ', strtoupper($permiso['tabla'])) }}</label>
                    </div>
                    <div class="col-lg-1">
                      <input type="checkbox" class="check-all" data-id="{{$key2}}">
                    </div>
                    <div class="col-lg-1">
                      <input type="checkbox" class="dashboard-{{$key2}}" name="dashboard[{{$key2}}]" value="dashboard {{$permiso['tabla']}}">
                    </div>
                    <div class="col-lg-1">
                      <input type="checkbox" class="listar-{{$key2}}" name="listar[{{$key2}}]" value="index {{$permiso['tabla']}}">
                    </div>
                    <div class="col-lg-1">
                      <input type="checkbox" class="crear-{{$key2}}" name="crear[{{$key2}}]" value="create {{$permiso['tabla']}}">
                    </div>
                    <div class="col-lg-1">
                      <input type="checkbox" class="editar-{{$key2}}" name="editar[{{$key2}}]" value="edit {{$permiso['tabla']}}">
                    </div>
                    <div class="col-lg-1">
                      <input type="checkbox" class="ver-{{$key2}}" name="ver[{{$key2}}]" value="show {{$permiso['tabla']}}">
                    </div>
                    <div class="col-lg-1">
                      <input type="checkbox" class="eliminar-{{$key2}}" name="eliminar[{{$key2}}]" value="destroy {{$permiso['tabla']}}">
                    </div>
                    <div class="col-lg-1">
                      <input type="checkbox" class="reportar-{{$key2}}" name="reportar[{{$key2}}]" value="report {{$permiso['tabla']}}">
                    </div>
                  </div>
                @endforeach
              @endif
            @endforeach
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary" type="submit">{{__('Guardar')}}</button>
          <button class="btn btn-danger" type="reset">{{__('Cancelar')}}</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.check-all').forEach(function (element) {
      element.addEventListener('change', function () {
        let id = this.getAttribute('data-id');
        let isChecked = this.checked;

        document.querySelectorAll('.dashboard-' + id).forEach(function (el) {
          el.checked = isChecked;
        });
        document.querySelectorAll('.listar-' + id).forEach(function (el) {
          el.checked = isChecked;
        });
        document.querySelectorAll('.crear-' + id).forEach(function (el) {
          el.checked = isChecked;
        });
        document.querySelectorAll('.editar-' + id).forEach(function (el) {
          el.checked = isChecked;
        });
        document.querySelectorAll('.ver-' + id).forEach(function (el) {
          el.checked = isChecked;
        });
        document.querySelectorAll('.eliminar-' + id).forEach(function (el) {
          el.checked = isChecked;
        });
        document.querySelectorAll('.reportar-' + id).forEach(function (el) {
          el.checked = isChecked;
        });
      });
    });
  });
</script>
