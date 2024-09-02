<x-app-layout>
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>{{ __('Reporte de') }} Clientes</h3>
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<script> document.title = "{{ __('Reporte de') }} Clientes"; </script>
			<table id="reporte" class="table table-striped table-bordered table-condensed table-hover table-responsive-sm">
				<thead>
					
					<th class="text-center">ID</th>
					<th class="text-center">PERSONA</th>
				</thead>
                @foreach ($clientes as $cliente)
					<tr>
						
						<td class="text-center">{{$cliente->id}}</td>
						<td class="text-center">{{$cliente->persona->razon_social}}</td>
					</tr>
				@endforeach
			</table>
		</div>
		{{$clientes->render()}}
	</div>
</div>
</x-app-layout>