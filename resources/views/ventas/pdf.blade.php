<!DOCTYPE html>
<html lang="en">
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>VENTAS</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- <link rel="stylesheet" href="{{ public_path('css/app.css') }}">
 
    <link rel="stylesheet" href="{{ public_path('css/select2.min.css') }}" >
    <link rel="stylesheet" href="{{ public_path('css/select2-bootstrap4.min.css') }}"> -->
    
    <style>
    	html {
			margin: 20pt 15pt;
			font-size: 65%;
		}
	    table
	    {
	        width: 100%;
/*	        margin: 0px auto;*/
	    }
	    tr{
	    	text-align: left;
	    }
	    th
	    {
	        text-align: left;
	        vertical-align: left;
	        border: 1px solid black;
	        background-color: white;
	        color: black;
	    }  
	    td
	    {
	    	text-align: left
	    }
	    .table-container {
		    margin: 0 auto; /* Esto centrará el contenedor en la página */
		    width: 80%; /* Ajusta el ancho del contenedor según tus necesidades */
		}

	  	.table-condensed tbody tr {
	        line-height: 0; /* Ajusta el valor según tus preferencias */
	    }
	    .table-custom thead th {
            background-color: transparent;
            color: black; /* Color del texto en la cabecera */
        }

        .table-custom tbody td {
            background-color: transparent;
            color: black; /* Color del texto en las celdas */
        }

	</style>
</head>
<body>
	<div class="row ml-5">
		<div class="col-lg-12">
			<label for="venta"> ========================</label>
		</div>
		<div class="col-lg-12">
			<label for="venta"> Ventas Nro: {{ $venta->id }}</label>
		</div>
		<div class="col-lg-12">
			<label for="venta"> ========================</label>
		</div>
		
		<div class="col-lg-12">
			<label for="numero_comprobante"> NUMERO COMPROBANTE: {{$venta->numero_comprobante }}</label>
		</div>
		
		<!-- <div class="col-lg-12">
			<label for="total"> TOTAL: {{$venta->total }}</label>
		</div> -->
		
		<div class="col-lg-12">
			<label for="estado"> ESTADO: {{$venta->estado ? 'Activo' : 'Inactivo' }}</label>
		</div>
		
		<div class="col-lg-12">
			<label for="cliente->id"> CLIENTE: {{$venta->cliente->persona->razon_social }}</label>
		</div>
		
		<div class="col-lg-12">
			<label for="comprobante->tipo_comprobante"> COMPROBANTE: {{$venta->comprobante->tipo_comprobante }}</label>
		</div>
		
	</div>
	<!-- <div class="col-lg-12">
		<label for="total"> ========================</label>
	</div> -->
	 <div class="row"> 
		<div class="col-lg-6">
			<div class="table-container">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-condensed table-hover table-responsive-sm table-custom">
						<thead class="thead-dark">
							
							<th class="text-left">PRODUCTO</th>
							<th class="text-right">CANTIDAD</th>
							<th class="text-right">PRECIO</th>
							<th class="text-right">DESCUENTO</th>
							<th class="text-right">SUBTOTAL</th>
						</thead>
						<br>
		               @foreach ($detalle_ventas as $detalle_venta)
						<tr>
							
							<td>{{$detalle_venta->producto->nombre}}</td>
							<td>{{$detalle_venta->cantidad}}</td>
							<td>{{$detalle_venta->precio}}</td>
							<td>{{$detalle_venta->descuento}}</td>
							<td>{{$detalle_venta->subtotal}}</td>
						</tr>
						@endforeach
						<!-- <tfoot>
							<td colspan="4" class="text-right"><b> Total : {{ $venta->total }} </b></td>
						</tfoot> -->
					</table>
				</div>
			</div>
		</div>
	</div>
	
	<div class="col-lg-12">
		<label for="total"> ========================</label>
	</div>
	<div class="col-lg-12">
		<label for="total"> Total : {{ $venta->total }}</label>
	</div>
	<div class="col-lg-12">
		<label for="total"> ========================</label>
	</div>
</body>  
</html>