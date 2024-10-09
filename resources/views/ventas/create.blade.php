<x-app-layout>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
<style>
    .choices {
        height: 29px ; /* Permite que el tamaño se ajuste automáticamente */
        font-size: 10px;
    }
    .choices__inner {
        height: 26px; /* Ajusta la altura según tus necesidades */
        padding: 0px; /* Ajusta el padding interno si es necesario */
    }
    .choices__item {
        line-height: 1; /* Ajusta el line-height para los ítems */
    }
    .choices__input {
        height: 26px; /* Asegúrate de que el campo de entrada tenga la misma altura */
        padding: 0px; /* Asegura que el padding sea consistente */
    }

    /* Ajusta el estilo de los ítems seleccionados */
    .choices__item--highlighted {
        background: #f0f0f0; /* Cambia el fondo al resaltar */
    }
</style>

<h3>{{ __('Registrar') }} Venta</h3>
@if ($errors->any())
<div class="alert alert-danger">
	<ul>
	 @foreach ($errors->all() as $error)
		<li>{{$error}}</li>
	 @endforeach
	</ul>
</div>
@endif

<form action="{{ url('ventas') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
  @csrf
  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Ventas</h3>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-lg-4">
          <div class="form-group">
            <label for="fecha_venta">FECHA VENTA</label>
            <input type="datetime-local" name="fecha_venta" id="fecha_venta" value="{{old('fecha_venta',$hoy->format('Y-m-d H:i:s'))}}" value="{{ old('fecha_venta') }}" class="form-control" placeholder="{{__('Digite aquí') }} Fecha Venta..." >
            @error('fecha_venta') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
          </div>
        </div>
        <div class="col-lg-4">
          <div class="form-group">
            <label for="numero_comprobante">NUMERO COMPROBANTE *</label>
           	<input type="text" name="numero_comprobante" id="numero_comprobante"  value="AUTOGENERADO" class="form-control" placeholder="{{__('Digite aquí') }} Numero Comprobante *..." readonly>
            @error('numero_comprobante') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
          </div>
        </div>
        <div class="col-lg-4 d-none">
          <div class="form-group">
              <label>Estado(*)</label>
              <select name="estado" class="form-control"  required>
                  <option value="1">Activo</option><option value="0">Inactivo</option>
              </select>
          </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label>CLIENTE *</label>
                <select name="idCliente" id="idCliente" class="form-control" required>
                    <option value="">{{ __('Seleccionar') }} CLIENTE</option>
                    @foreach ($clientes as $cliente)
                        <option {{ old('idCliente') == $cliente->id ? 'selected' : '' }} 
                                value="{{ $cliente->id }}">{{ $cliente->persona->razon_social }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-lg-4">
      		<div class="form-group">
      			<label>COMPROBANTE *</label>
      			<select name="idComprobante" id="idComprobante" class="form-control" required>
      				<option value="">{{ __('Seleccionar') }} COMPROBANTE</option>
      					@foreach ($comprobantes as $comprobante)
      					<option {{ old('idComprobante') == $comprobante->id ? 'selected' : '' }} 
      										value="{{$comprobante->id}}">{{ $comprobante->tipo_comprobante }}</option>
      					@endforeach
      			</select>
      		</div>
      	</div>
                                
      </div>
      <div class="card card-primary">
        <div class="card-header">
            Detalle de Ventas
        </div>
        <div class="card-body">
          <div class="row"> 
            <div class="col-lg-4">
          		<div class="form-group">
          			<label>PRODUCTO *</label>
          			<select name="idProducto" id="idProducto" class="form-control" >
          				<option value="">{{ __('Seleccionar') }} PRODUCTO</option>
          					@foreach ($productos as $producto)
          					<option {{ old('idProducto') == $producto->id ? 'selected' : '' }} 
          										value="{{$producto->id}}">{{ $producto->nombre }}</option>
          					@endforeach
          			</select>
          		</div>
          	</div>
                                
            <div class="col-lg-2">
              <div class="form-group">
                <label for="cantidad">CANTIDAD *</label>
                <input type="number" name="cantidad" id="cantidad" class="form-control" placeholder="Digite aquí CANTIDAD *..." onchange="validarCantidad();calcularSubtotal();">
                @error('cantidad') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
              </div>
            </div>
            
            <div class="col-lg-3">
              <div class="form-group">
                <label for="precio">PRECIO *</label>
                <input type="decimal" name="precio" id="precio" class="form-control" placeholder="Digite aquí PRECIO *..." onchange="validarPrecio();calcularSubtotal();" readonly>
                @error('precio') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
              </div>
            </div>
            <div class="col-lg-3">
              <div class="form-group">
                <label for="stock">STOCK *</label>
                <input type="number" name="stock" id="stock" class="form-control" placeholder="Digite aquí PRECIO *..." readonly>
                @error('stock') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
              </div>
            </div>
            <div class="col-lg-4">
              <div class="form-group">
                <label for="descuento">DESCUENTO (%)</label>
                <input type="decimal" name="descuento" id="descuento" class="form-control" placeholder="Digite aquí DESCUENTO..." onchange="calcularSubtotal();">
                @error('descuento') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
              </div>
            </div>
            
            <div class="col-lg-4">
              <div class="form-group">
                <label for="subtotal">SUBTOTAL *</label>
                <input type="decimal" name="subtotal" id="subtotal" class="form-control" placeholder="Digite aquí SUBTOTAL *..." onchange="calcularSubtotal();">
                @error('subtotal') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
              </div>
            </div>
            
            <div class="col-lg-4 align-self-end"> 
                  <div class="form-group">
                    <a href="#" onclick="agregar();" class="btn btn-success d-block mt-auto" title="Presione boton para agregar items a Ventas">{{__('Agregar')}}</a>
                  </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="table-responsive">
                  <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                      <thead class="thead-dark">
                          <th class="text-left">PRODUCTO</th>
                          <th class="text-right">CANTIDAD</th>
                          <th class="text-right">PRECIO</th>
                          <th class="text-right">DESCUENTO (%)</th>
                          <th class="text-right">SUBTOTAL</th>
                          
                          <th class="text-center">{{ __('Opciones') }}</th>
                      </thead>
                      <tr>
                      </tr>
                      <tfoot>
                      <td colspan="4" class="text-right"><strong>Total :</strong></td>
                      <td  class="text-center"><h5><input class="text-center font-weight-bold" type="decimal" name="total" id="total" value="{{ number_format(0,2) }} " readonly></h5></td>
                    </tfoot>
                  </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <center>
        <div class="form-group text-right">
          <button class="btn btn-danger" type="reset">{{__('Cancelar')}}</button>
        	<button id="guardar" class="btn btn-primary" type="submit" title="Grabar datos ingresados">{{__('Guardar')}}</button>
        </div>
      </center>
    </div>
  </div>
</form>


<script>
  var cont=0;
  var total=0;
  index = cont;

  // Agrega item al detalle de Ventas
  function agregar(){
    // idProducto=document.getElementById('idProducto').value;   
    Producto=$("#idProducto option:selected").text(); 
    
    idProducto=$("#idProducto").val();
    cantidad=$("#cantidad").val();
    precio=$("#precio").val();
    descuento=$("#descuento").val();
    subtotal=$("#subtotal").val();
    
    if(idProducto!=""  && cantidad!=""  && precio!=""){
      total = (Number(total)+Number(subtotal)).toFixed(2);
      var fila='</tr><tr class="selected" id="fila'+index+'"><td class="text-left"><input id="idProducto'+index+'" type="hidden" name="aidProducto[]" value="'+idProducto+'">'+Producto+'</td><td class="text-right"><input id="cantidad'+index+'" type="hidden" name="acantidad[]" value="'+cantidad+'">'+cantidad+'</td><td class="text-right"><input id="precio'+index+'" type="hidden" name="aprecio[]" value="'+precio+'">'+precio+'</td><td class="text-right"><input id="descuento'+index+'" type="hidden" name="adescuento[]" value="'+descuento+'">'+descuento+'</td><td class="text-right"><input id="subtotal'+index+'" type="hidden" name="asubtotal[]" value="'+subtotal+'">'+subtotal+'</td><td class="text-center"><button type="button" class="btn btn-warning" onclick="eliminar('+index+');">X</button></td>';
      cont++; index++;
      limpiar();
      $("#total").val(total);
      evaluar();
      $('#detalles').append(fila);
    }else{
      alert("Error al ingresar el detalle de Ventas, revise los datos");
    }
  }
  function limpiar(){
    
    $("#idProducto").val("")
    $("#cantidad").val("")
    $("#precio").val("")
     $("#stock").val("")
    $("#descuento").val("")
    $("#subtotal").val("")
  }

  // Al presiona X elimina la fila
  function eliminar(index){
    cont--;
    total=total-$("#subtotal" + index).val();
    $("#total").val(total);
    $("#fila" + index).remove();
    evaluar();
  }

  function evaluar(){
    if(cont>0){
      $("#guardar").show();
    } else {
      $("#guardar").hide();
    }
  }
  // Calculo de subtotal
  function calcularSubtotal() {
    const cantidad = $("#cantidad").val();
    const precio = $("#precio").val();
    const descuento = $("#descuento").val(); // Se asume que este es un porcentaje

    // Calcular el subtotal
    const subtotalBruto = Number(cantidad) * Number(precio);
    const descuentoDecimal = Number(descuento) / 100; // Convertir el porcentaje a decimal
    const totalDescuento = subtotalBruto * descuentoDecimal; // Calcular el monto del descuento
    const subtotal = (subtotalBruto - totalDescuento).toFixed(2); // Restar el descuento del subtotal bruto

    // Establecer el valor del subtotal
    $("#subtotal").val(subtotal);
  }

  // Tomar el Precio
  document.getElementById("idProducto" ).addEventListener( "change" , colocarPrecio);  

  function colocarPrecio(){
     const productos= @json($productos);
     idProducto=document.getElementById('idProducto').value;
     const result = productos.filter(productos=> productos.id === Number(idProducto)); 
     if(idProducto>0){
         $("#precio").val(result[0].precio);
         $("#stock").val(result[0].stock);

      }
  }
</script>
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const clienteElement = document.getElementById('idCliente');
        if (clienteElement) {
            new Choices(clienteElement, {
                placeholderValue: 'Seleccionar CLIENTE',
                searchEnabled: true,
                shouldSort: false,
            });
        }
        const productoElement = document.getElementById('idProducto');
        if (productoElement) {
            new Choices(productoElement, {
                placeholderValue: 'Seleccionar PRODUCTO',
                searchEnabled: true,
                shouldSort: false,
            });
        }
    });
    function validarCantidad() {
      const cantidadInput = document.getElementById('cantidad');
      const cantidad = parseFloat(cantidadInput.value);
      const stockInput = document.getElementById('stock');
      const stock = parseFloat(stockInput.value);
      if (cantidad < 0) {
          alert('La cantidad no puede ser negativa.');
          cantidadInput.value = 0; // Restablecer a 0 o a otro valor válido
          cantidadInput.focus(); // Focaliza el input para que el usuario lo corrija
      } else if (cantidad > stock) {
        alert('La cantidad no puede ser mayor que el stock disponible.');
        cantidadInput.value = stock; // Restablecer al stock disponible
        cantidadInput.focus(); // Focaliza el input
      }
    }
    function validarPrecio() {
      const precioInput = document.getElementById('precio');
      const precio = parseFloat(precioInput.value);

      if (precio < 0) {
          alert('El precio no puede ser negativo.');
          precioInput.value = 0; // Restablecer a 0 o a otro valor válido
          precioInput.focus(); // Focaliza el input para que el usuario lo corrija
      }
    }
</script>
</x-app-layout>