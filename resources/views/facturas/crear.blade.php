@extends('layouts.app')

@section('content')
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<section class="section">
<div class="section-header">
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
                        <div class="alert alert-dark alert-dimissible fade show" role="alert">
                            <strong>Revise los Campos!</strong>
                            @foreach($errors->all() as $error)
                            <span class="badge badge-danger">{{$error}}</span>
                            <button class="close" data-dismiss="alert" arial-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            @endforeach

                        </div>
                        @endif

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
                                        <select name='product[]' id="nombre" class="form-control">
                                        <option value="" disabled>Seleccione una Opcion</option>
                                        @foreach($productos as $producto)
                                        <option value="{{$producto->id_producto}}">{{$producto->nombre}}</option>
                                        @endforeach
                                        </select> 
                                        @if(empty($producto))
                                        <a href="/productos">¿No tienes Productos?, Pulsa Aqui para Añadir</a>
                                        @endif 
                                    </td>

                                    <td><input type="number" name='qty[]' placeholder='Ingresa la Cantidad a llevar' class="form-control qty" step="0" min="0"/></td>
                                    <td><input type="number" name='price[]' placeholder='Precio del Producto' class="form-control price" step="0.00" min="0"/></td>
                                    <td><input type="number" name='total[]' placeholder='0.00' class="form-control total" readonly/></td>
                                </tr>
                                <tr id='addr1'></tr>
                                </tbody>
                            </table>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-md-12">
                            <button id="add_row" class="btn btn-primary pull-left">Añadir Fila</button>
                            <button id='delete_row' class="btn btn-primary pull-right ">Eliminar Fila</button>
                            </div>
                        </div>
                    
  
                            <div class="row mt-2">
                                <div class="col-12 col-md-6 col-lg-12">
                                    <div class="card card-primary">
                                    <div class="card-header">
                                        <h4>Total Facturado</h4>
                                    </div>
                                    <div class="card-body" >
                                    <table class="table table-bordered table-hover" id="tab_logic_total">
                                        <tbody>
                                        <tr>
                                            <td class="text-center"><input type="number" name='sub_total' placeholder='0.00' class="form-control" id="sub_total" readonly/></td>
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

                            <div class="col-xs-12 col-sm-12 col-md-12 mt-3">
                        <button type="button" class="btn btn-primary">Guardar</button>
                        <a href="/facturas" class="btn btn-secondary">Cancelar</a>

                    </div>
                    </div>
                    </form>



                </div>
            </div>
        </div>
    </div>
    </div>
    
<script>
$(document).ready(function(){
    var i=1;
    $("#add_row").click(function(){b=i-1;
        $('#addr'+i).html($('#addr'+b).html()).find('td:first-child').html(i+1);
        $('#tab_logic').append('<tr id="addr'+(i+1)+'"></tr>');
        i++; 
    });
    $("#delete_row").click(function(){
        if(i>1){
        $("#addr"+(i-1)).html('');
        i--;
        }
        calc();
    });
    
    $('#tab_logic tbody').on('keyup change',function(){
        calc();
    });
    $('#tax').on('keyup change',function(){
        calc_total();
    });
    

});

function calc()
{
    $('#tab_logic tbody tr').each(function(i, element) {
        var html = $(this).html();
        if(html!='')
        {
            var qty = $(this).find('.qty').val();
            var price = $(this).find('.price').val();
            $(this).find('.total').val(qty*price);
            
            calc_total();
        }
    });
}

function calc_total()
{
    total=0;
    $('.total').each(function() {
        total += parseInt($(this).val());
    });
    $('#sub_total').val(total.toFixed(2));
    tax_sum=total/100*$('#tax').val();
    $('#tax_amount').val(tax_sum.toFixed(2));
    $('#total_amount').val((tax_sum+total).toFixed(2));
}
</script>

</section>
@endsection
