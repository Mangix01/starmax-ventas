@extends ('layouts.admin')
@section ('contenido')

@can('show users')
@include('users.show')
@endcan

<script>
    $(document).ready(function() {
        $('#modal-ver-{{$user->id}}').modal('show');
    });
</script>

@endsection