@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Productos Inactivos</h3>
    </div>
    <div class="section-body">
        <h2 class="section-title">Listado productos Inactivos</h2>
        <p class="section-lead">La siguiente tabla le permitira ver los productos Inactivos, Si desea Activarlos simplemente de al boton de Habilitar.</p>

    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <a class="btn btn-info mb-3" href="/productos">Productos Activos</a>
                        <table class="table table-stripped mt-2" id="listado">
                            <thead>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Tipos</th>
                                <th>Precio</th>

                                <th>Creado por</th>
                                <th>Hora de Creacion</th>
                                @if ($rol===1)
                                <th>Estado</th>
                                <th>ACCIONES</th>
                                @endif
                            </thead>
                            <tbody>
                                @foreach($productos as $producto)
                                <tr>
                                    <td>{{$producto->id_producto}}</td>
                                    <td>{{$producto->nombre}}</td>
                                    <td>{{$producto->tipo}}</td>
                                    <td>{{$producto->precio}}</td>

                                    <td>
                                        <span class="badge badge-pill badge-primary">{{$producto->name}}</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-pill badge-light">{{ \Carbon\Carbon::parse($producto->created_at)->formatLocalized('%d %B %Y %I:%M %p');}}</span>
                                    </td>
                                    <td>
                                    <span class="badge badge-pill badge-danger">INACTIVO</span>

                                    </td>
                                    @if($rol===1)

                                    <td>
                                        <a href="{{ route('productos.activo',$producto->id_producto) }}" class="btn btn-success" onclick="validacion(event)">Activar</a>
                                    </td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="pagination justify-content-end">
                            {!! $productos->links() !!}
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script src="{{ asset('assets/js/sweetalert2.all.min.js') }}"></script>
<link href="{{ asset('assets/css/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>

@if(session('Activado')== "ok")
<script>
    Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'Activado con Exito!',
        showConfirmButton: false,
        timer: 1000
    })
</script>
@endif

<script>
function validacion(event) {
    event.preventDefault();

    Swal.fire({
            title: 'Estas Seguro de Habilitar el Producto?',
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Confirmar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = event.target.href;
            }
        })
}



</script>
<script>
    $('#listado').dataTable({
        language: {
            "decimal": "",
            "emptyTable": "No hay información",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
            "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
            "infoFiltered": "(Filtrado de _MAX_ total entradas)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ Entradas",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "Sin resultados encontrados",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        },
    });
</script>
@endsection