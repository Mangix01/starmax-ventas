<div class="modal fade" id="modal-delete-{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <form action="{{ action('App\Http\Controllers\UsersControlador@destroy', $user->id) }}" method="POST">
    @csrf
    @method('DELETE')
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header colorModal">
        <h4 class="modal-title" id="exampleModalLabel">{{__('Eliminar')}} Usuario</h4>
        <button type="button" class="btn btn-close btn-danger pull-right" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">X</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Confirme si desea Eliminar Usuario : {{$user->name}}</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">{{__('Cerrar')}}</button>
		    <button type="submit" class="btn btn-primary">{{__('Confirmar')}}</button>
      </div>
    </div>
  </div>
  </form>
</div>