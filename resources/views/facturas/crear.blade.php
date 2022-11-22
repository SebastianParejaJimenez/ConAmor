@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-body">
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


                        <form action="{{ route('proveedores.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <select name="" id="nombre" class="form-control">
                                        <option value="" selected>Seleccione una Opcion</option>
                                        @foreach($productos as $producto)
                                        <option value="{{$producto->id}}">{{$producto->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <input type="text" id="precio" class="form-control" placeholder="Precio">
                                </div>
                                <div class="col">
                                    <input type="text" id="cantidad" class="form-control" placeholder="Cantidad">
                                </div>
                                <div class="col">
                                    <input onclick="btnAdd()" type="button" class="btn btn-primary form-control" value="Guardar">

                                </div>
                            </div>


                            <table class="table table-stripped mt-2" id="tabla">
                                <thead>
                                    <th>Nombre</th>
                                    <th>Precio</th>
                                    <th>Cantidad</th>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>

                            <button disabled type="button" class="btn btn-primary" id="totalf"></button>

                            <div class="col-xs-12 col-sm-12 col-md-12 mt-3">
                        <button type="button" class="btn btn-primary">Guardar</button>
                        <a href="/proveedores" class="btn btn-secondary">Cancelar</a>

                    </div>
                    </div>
                    </form>



                </div>
            </div>
        </div>
    </div>
    </div>
    
<script>
    var n= 0
var total = 0
var totalfactura = 0
var acomulador = 0
function btnAdd(){
    var prod = document.getElementById("nombre")
    var nameproduct = prod.options[prod.selectedIndex].text
    var cantidad = document.getElementById("cantidad").value
    var precio = parseInt(document.getElementById("precio").value)

    total = precio*cantidad


    var tabla= document.getElementById("tabla")
    var fila = tabla.insertRow(tabla.rows.lenght)
    fila.innerHTML = "<tr><td>"+ nameproduct + "</td><td>" + precio + "</td><td>"+ cantidad + "</td></tr>"//Esta propiedad nos permite mandar strings

    totalfactura = parseInt(total)+ parseInt(totalfactura)

    document.getElementById("totalf").innerHTML=" <br> El total de su factura es: "+ totalfactura

}
</script>

</section>
@endsection
