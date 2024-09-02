<x-app-layout>
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>{{ __('Reporte de') }} Auditoria</h3>
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<script> document.title = "{{ __('Reporte de') }} Auditoria"; </script>
			<table id="reporte" class="table table-striped table-bordered table-condensed table-hover table-responsive-sm">
				<thead>
					
					<th class="text-center">ID</th>
					<th class="text-center">FECHA</th>
					<th class="text-center">OPERACION</th>
					<th class="text-center">NOTAS</th>
				</thead>
                @foreach ($auditoria as $auditori)
					<tr>
						
						<td class="text-center">{{$auditori->id}}</td>
						<td class="text-center">{{$auditori->fecha}}</td>
						<td class="text-center">{{$auditori->operacion}}</td>
						<td class="text-center">{{$auditori->notas}}</td>
					</tr>
				@endforeach
			</table>
		</div>
		{{$auditoria->render()}}
	</div>
</div>
</x-app-layout>