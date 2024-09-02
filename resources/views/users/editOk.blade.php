@extends ('layouts.admin')
@section ('contenido')

@can('edit users')
@include('users.edit')
@endcan

<script>
    $(document).ready(function() {
        $('#modal-edit-{{$user->id}}').modal('show');
    });
</script>

@endsection