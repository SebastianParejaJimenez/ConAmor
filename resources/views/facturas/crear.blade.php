@extends('layouts.app')

@section('content')


<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<section class="section">
    <div class="section-header">
        <h1>Facturacion</h1>
    </div>
    <div class="section-body">
        <h2 class="section-title">Generar Facturas</h2>
        <p class="section-lead">El siguiente formulario le permitira Generar Facturas según los Productos a Seleccionar.</p>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <!--Para atrapar errores y mostrarlos-->
                         @if($errors->any())
                        <div class="alert " role="alert">
                            @foreach($errors->all() as $error)
                            <button type="button" data-dismiss="alert" arial-label="Close" class="btn btn-primary btn-icon icon-left">
                                <i class="fas fa-eye"></i> Error: <span class="badge badge-transparent">{{$error}}</span>
                            </button>
                            @endforeach
                        </div>
                        @endif

                        <form action="{{ route('facturas.store')}}" method="POST">
                            @csrf
                            <div class="row clearfix">
                                <div class="col-md-12">
                                    <table class="table table-sm table-hover" id="tab_logic">
                                        <thead>
                                            <tr>
                                                <th class="text-center"> # </th>
                                                <th class="text-center"> Productos </th>
                                                <th class="text-center"> Cantidad </th>
                                                <th class="text-center"> Precio </th>
                                                <th class="text-center"> Total </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr id='addr0'>
                                                <td>1</td>

                                                <td>
                                                    <select name='producto[]' id="product_id" class="form-control select2">
                                                        <option value="" disabled selected>Seleccione una Opcion</option>
                                                        @foreach($productos as $producto)
                                                        <option value="{{$producto->id_producto}}">{{$producto->nombre}}</option>
                                                        @endforeach
                                                    </select>
                                                    @if(empty($producto))
                                                    <a href="{{ url('/productos') }}">¿No tienes Productos?, Pulsa Aqui para Añadir</a>
                                                    @endif
                                                </td>

                                                <td><input name='cantidad[]' placeholder='Ingresa la Cantidad a llevar' class="form-control cantidad"/></td>
                                                <td><input type="number" name='precio[]' placeholder='Precio del Producto' class="form-control precio price-input" readonly/></td>
                                                <td><input id="total_calc" type="" name='total_cantidad[]' placeholder='Total' class="form-control total" readonly value="" /></td>
                                            </tr>
                                            <tr id='addr1'></tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-md-12">
                                    <input type="button" id="add_row" class="btn btn-primary pull-left" value="Añadir Fila">
                                    <input type="button" id='delete_row' class="btn btn-primary pull-right " value="Eliminar Fila">
                                </div>
                            </div>


                            <div class="row mt-2">
                                <div class="col-12 col-md-6 col-lg-12">
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h4>Total Facturado</h4>
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-bordered table-hover" id="tab_logic_total">
                                                <tbody>
                                                    <tr>
                                                        <td class="text-center"><input name='total' placeholder='0' class="form-control" id="sub_total" readonly /></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row mt-1">
                                        <div class="col-12 col-md-6 col-lg-12">
                                            <div class="card-header">
                                                <h4>Cliente</h4>
                                                <select name='cliente_id' id="nombre" class="form-control select2">
                                                    <option value="" selected disabled>Seleccione una Opcion</option>
                                                    @foreach($clientes as $cliente)
                                                    <option value="{{$cliente->id_cliente}}">{{$cliente->nombre_cliente}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @if(empty($cliente))
                                                    <a href="{{ url('/clientes') }}">¿No tienes Clientes?, Pulsa Aqui para Añadir</a>
                                            @endif
                                        </div>
                                        <input type="hidden" name="estado" value="ACTIVO">
                        </form>
                        <div class="col-xs-12 col-sm-12 col-md-12 mt-3">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                            <a href="{{ url('/facturas') }}" class="btn btn-secondary">Cancelar</a>

                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <script>
        $(document).ready(function() {
            $('#product_id').on('change', function() {
                updatePrice($(this));
            });
            $('#tab_logic').on('change', '.product-select', function() {
                updatePrice($(this));
            });

        });

        $(document).ready(function() {
  // Inicializar Select2 en el select principal
  $("#product_id").select2();

  // Ajustar el ancho del select principal después de un breve retraso
  setTimeout(function() {
    $("#product_id").next(".select2-container").css("width", "100%");
  }, 100);

  // Restaurar el ancho del select principal al cambiar el tamaño de la ventana
  $(window).on("resize", function() {
    $("#product_id").next(".select2-container").css("width", "100%");
  });
});


        function updatePrice(selectElement) {
            var product_id = selectElement.val();
            var priceElement = selectElement.closest('tr').find('.precio');

            if (product_id) {
                $.ajax({
                    url: "{{ route('get-product-price', ':id_producto') }}".replace(':id_producto', product_id),
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        priceElement.val(data.precio);
                        calc();
                    }
                });
            } else {
                priceElement.val('');
                calc();
            }
        }
        $(document).ready(function() {
            
    $("#add_row").click(function() {
        
        // Obtener el número de filas actual
        var current_row = $("#tab_logic tbody tr:last").attr("id");
        var current_index = parseInt(current_row.replace("addr", ""));
        
        // Crear una nueva fila con el mismo formato que las existentes
        var new_row = "<tr id='addr" + (current_index + 1) + "'>";
        new_row += "<td>" + (current_index + 1) + "</td>";
        new_row += "<td><select name='producto[]' id='product_id_" + (current_index + 1) + "' class='form-control product-select'>";
        new_row += "<option value='' disabled selected>Seleccione una Opcion</option>";
        new_row += "@foreach($productos as $producto)<option value='{{$producto->id_producto}}'>{{$producto->nombre}}</option>@endforeach";
        new_row += "</select></td>";
        new_row += "<td><input type='number' name='cantidad[]' min='1' placeholder='Ingresa la Cantidad a llevar' class='form-control cantidad'/></td>";
        new_row += "<td><input type='number' name='precio[]' placeholder='Precio del Producto' class='form-control precio price-input' readonly/></td>";
        new_row += "<td><input id='total_calc_" + (current_index + 1) + "' type='' name='total_cantidad[]' placeholder='Total' class='form-control total' readonly value='' /></td>";
        new_row += "</tr>";
        
        // Agregar la nueva fila a la tabla
        $("#tab_logic tbody").append(new_row);
        var product_id = $(this).val();
        var priceElement = $(this).closest('tr').find('.precio');
        // Actualizar el evento onchange de la lista desplegable de productos
        $("#product_id_" + (current_index + 1)).on("change", function() {
            updatePrice($(this));
        });
        $("#product_id_" + (current_index + 1)).select2();
        $("#product_id_" + (current_index + 1)).next(".select2-container").addClass("w-100");
    });
    
    $("#delete_row").click(function() {
        // Obtener el número de filas actuales
        var current_row = $("#tab_logic tbody tr:last").attr("id");
        var current_index = parseInt(current_row.replace("addr", ""));
        // No se pueden borrar todas las filas
        if (current_index ==1) {
            return;
        }
        // Borrar la última fila de la tabla
        $("#addr" + current_index).remove();
        calc_total();

    });

            $('#tab_logic tbody').on('keyup change', function() {
                calc();
            });
            $('#tax').on('keyup change', function() {
                calc_total();
            });


        });

        function calc() {
            $('#tab_logic tbody tr').each(function(i, element) {
                var html = $(this).html();
                if (html != '') {
                    var cantidad = $(this).find('.cantidad').val();
                    var precio = $(this).find('.precio').val();
                    var calctot = cantidad * precio
                    $(this).find('.total').val(cantidad * precio);
                    document.getElementById("total_calc").setAttribute('value', calctot);

                    calc_total();
                }
            });
        }

        function calc_total() {
            total = 0;
            $('.total').each(function() {
                total += parseInt($(this).val());
            });
            $('#sub_total').val(total.toFixed(2));
            tax_sum = total / 100 * $('#tax').val();
            $('#tax_amount').val(tax_sum.toFixed(2));
            $('#total_amount').val((tax_sum + total).toFixed(2));
        }

        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>

</section>
@endsection