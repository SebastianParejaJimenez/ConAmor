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
                        <!--                         Para atrapar errores y mostrarlos
 --> @if($errors->any())
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
                                                    <select name='producto[]' id="product_id" class="form-control">
                                                        <option value="" disabled selected>Seleccione una Opcion</option>
                                                        @foreach($productos as $producto)
                                                        <option value="{{$producto->id_producto}}">{{$producto->nombre}}</option>
                                                        @endforeach
                                                    </select>
                                                    @if(empty($producto))
                                                    <a href="/productos">¿No tienes Productos?, Pulsa Aqui para Añadir</a>
                                                    @endif
                                                </td>

                                                <td><input type="" name='cantidad[]' placeholder='Ingresa la Cantidad a llevar' class="form-control cantidad"/></td>
                                                <td><input type="" name='precio[]' placeholder='Precio del Producto' class="form-control precio price-input"/></td>
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
                                                        <td class="text-center"><input name='total' placeholder='0.00' class="form-control" id="sub_total" readonly /></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row mt-1">
                                        <div class="col-12 col-md-6 col-lg-12">
                                            <div class="card-header">
                                                <h4>Cliente</h4>
                                                <select name='cliente_id' id="nombre" class="form-control">
                                                    <option value="" disabled>Seleccione una Opcion</option>
                                                    @foreach($clientes as $cliente)
                                                    <option value="{{$cliente->id_cliente}}">{{$cliente->nombre_cliente}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                        </form>
                        <div class="col-xs-12 col-sm-12 col-md-12 mt-3">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                            <a href="/facturas" class="btn btn-secondary">Cancelar</a>

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
            var i = 1;
            $("#add_row").click(function() {
                b = i - 1;
                $('#addr' + i).html($('#addr' + b).html()).find('td:first-child').html(i + 1);
                $('#tab_logic').append('<tr id="addr' + (i + 1) + '"></tr>');
                i++;

                // Agregar evento de cambio para el producto seleccionado en la nueva fila
                $('#addr' + b).find('#product_id').on('change', function() {
                    var product_id = $(this).val();
                    var priceElement = $(this).closest('tr').find('.precio');

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
                });
            });

            $("#delete_row").click(function() {
                if (i > 1) {
                    $("#addr" + (i - 1)).html('');
                    i--;
                }
                calc();
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
    </script>

</section>
@endsection