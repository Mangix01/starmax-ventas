<x-app-layout>
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>{{ __('Reporte de') }} Productos</h3>
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<script> document.title = "{{ __('Reporte de') }} Productos"; </script>
			<table id="reporte" class="table table-striped table-bordered table-condensed table-hover table-responsive-sm">
				<thead>
					
					<th class="text-center">ID</th>
					<th class="text-center">CATEGORIA</th>
					<th class="text-center">CODIGO</th>
					<th class="text-center">NOMBRE</th>
					<th class="text-center">STOCK</th>
					<th class="text-center">MARCA</th>
					<th class="text-center">DESCRIPCION</th>
					<th class="text-center">PRECIO</th>
					<th class="text-center">ESTADO</th>
				</thead>
                @foreach ($productos as $producto)
					<tr>
						
						<td class="text-center">{{$producto->id}}</td>
						<td class="text-center">{{$producto->categoria->categoria}}</td>
						<td class="text-center">{{$producto->codigo}}</td>
						<td class="text-center">{{$producto->nombre}}</td>
						<td class="text-center">{{$producto->stock}}</td>
						<td class="text-center">{{$producto->marca}}</td>
						<td class="text-center">{{$producto->descripcion}}</td>
						<td class="text-center">{{$producto->precio}}</td>
						<td class="text-center"><button class="btn @if ($producto->estado==1 or $producto->estado== "active") btn-success @else btn-danger @endif  btn-sm">@if ($producto->estado==1 or $producto->estado=="active") Activo @else Inactivo @endif</button></td>
					</tr>
				@endforeach
			</table>
		</div>
		{{$productos->render()}}
	</div>
</div>
</x-app-layout>