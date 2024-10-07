
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

<h3>{{ __('Registrar') }} Compra</h3>
@if ($errors->any())
<div class="alert alert-danger">
	<ul>
	 @foreach ($errors->all() as $error)
		<li>{{$error}}</li>
	 @endforeach
	</ul>
</div>
@endif

<form action="{{ url('compras') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
  @csrf
  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Compras</h3>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-lg-4">
          <div class="form-group">
            <label for="fecha_recepcion">FECHA RECEPCION</label>
           	<input type="datetime-local" name="fecha_recepcion" id="fecha_recepcion" value="{{old('fecha_recepcion',$hoy->format('Y-m-d H:i:s'))}}" value="{{ old('fecha_recepcion') }}" class="form-control" placeholder="{{__('Digite aquí') }} Fecha Recepcion..." >
            @error('fecha_recepcion') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
          </div>
        </div>
        <div class="col-lg-4">
          <div class="form-group">
            <label for="numero_comprobante">NUMERO COMPROBANTE *</label>
           	<input type="text" name="numero_comprobante" id="numero_comprobante"  value="{{ old('numero_comprobante') }}" class="form-control" placeholder="{{__('Digite aquí') }} Numero Comprobante *..." required>
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
        <div class="col-lg-4">
          <div class="form-group">
            <label>PROVEEDORE *</label>
            <select name="idProveedore" id="idProveedore" class="form-control" required>
                <option value="">{{ __('Seleccionar') }} PROVEEDORE</option>
                @foreach ($proveedores as $proveedore)
                    <option {{ old('idProveedore') == $proveedore->id ? 'selected' : '' }} 
                            value="{{$proveedore->id}}">{{ $proveedore->persona->razon_social }}</option>
                @endforeach
            </select>
          </div>
        </div>
      </div>
      <div class="card card-primary">
        <div class="card-header">
            Detalle de Compras
        </div>
        <div class="card-body">
          <div class="row"> 
            <div class="col-lg-4">
                <div class="form-group">
                    <label>PRODUCTO *</label>
                    <select name="idProducto" id="idProducto" class="form-control">
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
          
            <div class="col-lg-2">
                <div class="form-group">
                    <label for="precioCompra">PRECIO COMPRA*</label>
                    <input type="number" name="precio" id="precioCompra" class="form-control" 
                           placeholder="Digite aquí PRECIO COMPRA *..." step="0.1" onchange="validarPrecioCompra(); calcularSubtotal(); guardarUltimoPrecio('compra');">
                    @error('precioCompra') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
                </div>
            </div>

            <div class="col-lg-2">
                <div class="form-group">
                    <label for="precioVenta">PRECIO VENTA*</label>
                    <input type="number" name="precioVenta" id="precioVenta" class="form-control" 
                           placeholder="Digite aquí PRECIO VENTA *..." step="0.1" onchange="validarPrecioVenta(); guardarUltimoPrecio('venta');">
                    @error('precioVenta') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
                </div>
            </div>
            
            <div class="col-lg-2">
              <div class="form-group">
                <label for="subtotal">SUBTOTAL *</label>
                <input type="decimal" name="subtotal" id="subtotal" class="form-control" placeholder="Digite aquí SUBTOTAL *..." onchange="calcularSubtotal();" readonly>
                @error('subtotal') <div style="color:#FF0000"><strong>* {{ $message }} !!</strong></div> @enderror
              </div>
            </div>
          
            <div class="col-lg-4 align-self-end"> 
              <div class="form-group">
                <a href="#" onclick="agregar();" class="btn btn-success d-block mt-auto" title="Presione boton para agregar items a Compras">{{__('Agregar')}}</a>
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
                          <th class="text-right">PRECIO COMPRA</th>
                          <th class="text-right">PRECIO VENTA</th>
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

  // Agrega item al detalle de Compras
  function agregar(){
    // idProducto=document.getElementById('idProducto').value;   
    Producto=$("#idProducto option:selected").text(); 
    
    idProducto=$("#idProducto").val();
    cantidad=$("#cantidad").val();
    precio=$("#precioCompra").val();
    precioVenta=$("#precioVenta").val();
    subtotal=$("#subtotal").val();
    
    if(idProducto!=""){
      total = (Number(total)+Number(subtotal)).toFixed(2);
      var fila='</tr><tr class="selected" id="fila'+index+'"><td class="text-left"><input id="idProducto'+index+'" type="hidden" name="aidProducto[]" value="'+idProducto+'">'+Producto+'</td><td class="text-right"><input id="cantidad'+index+'" type="hidden" name="acantidad[]" value="'+cantidad+'">'+cantidad+'</td><td class="text-right"><input id="precio'+index+'" type="hidden" name="aprecio[]" value="'+precio+'">'+precio+'</td><td class="text-right"><input id="precioVenta'+index+'" type="hidden" name="aprecioVenta[]" value="'+precioVenta+'">'+precioVenta+'</td><td class="text-right"><input id="subtotal'+index+'" type="hidden" name="asubtotal[]" value="'+subtotal+'">'+subtotal+'</td><td class="text-center"><button type="button" class="btn btn-warning" onclick="eliminar('+index+');">X</button></td>';
      cont++; index++;
      limpiar();
      $("#total").val(total);
      evaluar();
      $('#detalles').append(fila);
    }else{
      alert("Error al ingresar el detalle de Compras, revise los datos");
    }
  }
  function limpiar(){
    
    $("#idProducto").val("")
    $("#cantidad").val("")
    $("#precioCompra").val("")
    $("#precioVenta").val("")
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
  function calcularSubtotal(){
    cantidad=$("#cantidad").val();
    precio=$("#precioCompra").val();
    subtotal = (Number(cantidad)*Number(precio)).toFixed(2);
    $("#subtotal").val(subtotal);
  }
  // Tomar el Precio
  document.getElementById("idProducto" ).addEventListener( "change" , colocarPrecio);  

  function colocarPrecio(){
     const productos= @json($productos);
     idProducto=document.getElementById('idProducto').value;
     const result = productos.filter(productos=> productos.id === Number(idProducto)); 
     if(idProducto>0){
        $("#precioCompra").val(result[0].precio_compra);
        $("#precioVenta").val(result[0].precio);
      }
  }

</script>
<!-- Choices.js -->
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const element = document.getElementById('idProveedore');
        if (element) {
            const choices = new Choices(element, {
                placeholderValue: 'Seleccionar PROVEEDORE',
                searchEnabled: true,
                shouldSort: false,
                // Otras opciones que desees agregar
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
      const cantidad = parseInt(cantidadInput.value);

      if (cantidad < 0) {
          alert('La cantidad no puede ser negativa.');
          cantidadInput.value = 0; // Restablecer a 0 o a otro valor válido
          cantidadInput.focus(); // Focaliza el input para que el usuario lo corrija
      }
    }
    function validarPrecioCompra() {
      const precioCompraInput = document.getElementById('precioCompra');
      const precioCompra = parseFloat(precioCompraInput.value);

      if (precioCompra < 0) {
          alert('El precio de compra no puede ser negativo.');
          precioCompraInput.value = 0; // Restablecer a 0 o a otro valor válido
          precioCompraInput.focus(); // Focaliza el input para que el usuario lo corrija
      }
    }
    function validarPrecioVenta() {
      const precioVentaInput = document.getElementById('precioVenta');
      const precioVenta = parseFloat(precioVentaInput.value);

      if (precioVenta < 0) {
          alert('El precio de venta no puede ser negativo.');
          precioVentaInput.value = 0; // Restablecer a 0 o a otro valor válido
          precioVentaInput.focus(); // Focaliza el input para que el usuario lo corrija
      }
    }
</script>

 <script>
        // Cargar los últimos precios guardados
        // document.addEventListener('DOMContentLoaded', function() {
        //     const ultimoPrecioCompra = localStorage.getItem('ultimoPrecioCompra');
        //     const ultimoPrecioVenta = localStorage.getItem('ultimoPrecioVenta');

        //     if (ultimoPrecioCompra) {
        //         document.getElementById('precioCompra').value = ultimoPrecioCompra;
        //     }
        //     if (ultimoPrecioVenta) {
        //         document.getElementById('precioVenta').value = ultimoPrecioVenta;
        //     }
        // });

        // // Función para guardar el último precio en localStorage
        // function guardarUltimoPrecio(tipo) {
        //     if (tipo === 'compra') {
        //         const precioCompra = document.getElementById('precioCompra').value;
        //         localStorage.setItem('ultimoPrecioCompra', precioCompra);
        //     } else if (tipo === 'venta') {
        //         const precioVenta = document.getElementById('precioVenta').value;
        //         localStorage.setItem('ultimoPrecioVenta', precioVenta);
        //     }
        // }
    </script>

</x-app-layout>