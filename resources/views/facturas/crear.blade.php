@extends('layouts.app')

@section('content')
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>

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


                        <form action="{{ route('facturas.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col">
                                      <select name="" id="nombre" class="form-control">
                                        <option value="" disabled>Seleccione una Opcion</option>
                                        @foreach($productos as $producto)
                                        <option value="{{$producto->id_producto}}">{{$producto->nombre}}</option>
                                        @endforeach
                                    </select>  
<!--                                    <div class="col">
                                    <input type="number" id="id" class="form-control" placeholder="ID" onchange="capturardatos()">
                                </div>      -->                          
                            </div>
                                <div class="col">
                                    <input type="number" id="precio" class="form-control" placeholder="Precio">
                                </div>
                                <div class="col">
                                    <input type="number" id="cantidad" class="form-control" placeholder="Cantidad">
                                </div>
                                <div class="col">
                                    <input onclick="btnAdd()" type="button" class="btn btn-primary form-control" value="Guardar">

                                </div>
                            </div>


                            <table class="table table-sm mt-2" id="tabla">
                                <thead>
                                    <th>Nombre</th>
                                    <th>Precio</th>
                                    <th>Cantidad</th>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                                <div class="row">
                                <div class="col-12 col-md-6 col-lg-12">
                                    <div class="card card-primary">
                                    <div class="card-header">
                                        <h4>Total Facturado</h4>
                                        <div class="card-header-action">
                                        <a href="#" class="btn btn-primary">
                                            a
                                        </a>
                                        </div>
                                    </div>
                                    <div class="card-body" >
                                        <p id="totalf">El total de los Insumos es de: </p>
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
var total = 0
var totalfactura = 0
function btnAdd(){
    var prod = document.getElementById("nombre")
    var nameproduct = prod.options[prod.selectedIndex].text
    var cantidad = document.getElementById("cantidad").value
    var precio = parseInt(document.getElementById("precio").value)

    if (cantidad<0 || precio<0) {

    }else{
        total = precio*cantidad
    var tabla= document.getElementById("tabla")
    var fila = tabla.insertRow(tabla.rows.lenght)
    fila.innerHTML = "<tr><td>"+ nameproduct + "</td><td>" + precio + "</td><td>"+ cantidad + "</td></tr>"//Esta propiedad nos permite mandar strings

    totalfactura = parseInt(total)+ parseInt(totalfactura)

    document.getElementById("totalf").innerHTML=" <br> El total de su factura es: "+ totalfactura
    }


}


function capturardatos(id){
    var id = $('#id').val();
    var ruta = "{{ route('productos.show', 1)}}"
    $.ajax({
        url: ruta,
        method: 'GET'
    }).then(function (datos){
        var datos = JSON.parse(datos.replace(/&quot;/g,'"'));
        console.log(datos);
    });


}

</script>

</section>
@endsection
