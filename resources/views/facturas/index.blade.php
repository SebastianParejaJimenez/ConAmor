@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Ventas</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            
                            <a class="btn btn-info mb-3" href="{{ route('facturas.create') }}">Crear Nueva Factura</a>
                        <div class="table-responsive">   
                            <table class="table table-stripped " id="listado_facturas">
                                <thead class="thead-dark">
                                    <th>ID</th>
                                    <th>Total</th>
                                    <th>Cliente</th>
                                    <th>Fecha de Creacion</th>
                                    <th>Estado</th>
                                    <th class="text-start">Acciones</th>
                                </thead>
                                <tbody>
                                @foreach($facturas as $factura)
                                    <tr>
                                        <td>{{$factura->id_factura}}</td>
                                        <td>{{$factura->total}}</td>
                                        <td>
                                            <span class="badge badge-pill badge-primary">{{$factura->nombre_cliente}} </span></td>
                                        <td>
                                        <span class="badge badge-pill badge-light">{{ \Carbon\Carbon::parse($factura->created_at)->formatLocalized('%d %B %Y %I:%M %p');}}</span>
                                        </td>
                                        <td>
                                        <span class="badge badge-pill badge-success">ACTIVO</span>
                                    </td>
                                        <td>
                                        <a href="{{ route('facturas.pdf',$factura->id_factura) }}" class="btn btn-success" >Detalles Factura</a>
                                        @if($rol==1)
                                        <form action="{{ route('facturas.destroy',$factura->id_factura) }}" method="POST" class="formulario-eliminar" style="display: inline;">
                                            @csrf

                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Inhabilitar</button>

                                        </form>
                                        @endif
                                    </td>
                                    </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="section-body">
                <div class="row">
                            <div class="card-body">
                                <div class="card">
                                    <div class="card-body">
                                    <h2 class="section-title">Estadisticas</h2>
                                        <p class="section-lead">El siguiente seleccionador le permitira seleccionar un año para poder consultar las estadisticas del año seleccionado.</p>
                                    <label for="">Seleccione un año al cual le desea ver sus ventas Mensuales:</label>
                                <select id="select-ano" class="form-control selectpicker" data-live-search="true"> 
                                    <option class="dropdown-item" selected disabled>Años</option>
                                    <option class="dropdown-item" value="2023">2023</option>
                                    <option class="dropdown-item" value="2024">2024</option>
                                    <option class="dropdown-item" value="2025">2025</option>
                                </select>

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
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-*.min.js"></script>
<script>
$(function () {
    $('select').selectpicker();
});
</script>
@if(session('creado')== "ok")
<script>
    Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'Creado con Exito!',
        showConfirmButton: false,
        timer: 1000
    })

</script>
@endif

<script>
    //NMensaje Confirmacion Boton Eliminar

        $('.formulario-eliminar').submit(function(e) {
        e.preventDefault();

        Swal.fire({
            title: '¿Estas Seguro de Eliminar esta Factura?',
            text: "No lo podras recuperarlo si lo eliminas.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Confirmar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        })

    });

    //Sacar Año y Redireccion Para Las Graficas
    const selectAno = document.getElementById('select-ano');
    selectAno.addEventListener('change', function() {
        const anoSeleccionado = selectAno.value;

        Swal.fire({
            title: `Ventas anuales ${anoSeleccionado}`,
            text: '¿Deseas ver las gráficas de ventas?',
            icon: 'info',
            showCancelButton: true,
            confirmButtonText: 'Sí',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ route('graficas.ventas', ['ano' => ':ano']) }}".replace(':ano', anoSeleccionado);
            }
        });
    });
</script>

<!-- DataTable Configuracion -->
 <script>
 $('#listado_facturas').dataTable({
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

 <!-- Mensaje de Eliminado -->

@if(session('eliminado')== "ok")
<script>
    Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'Eliminado con Exito!',
        showConfirmButton: false,
        timer: 900
    })
</script>

@endif
@endsection
