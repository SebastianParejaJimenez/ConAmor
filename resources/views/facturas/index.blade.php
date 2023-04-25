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
                            
                            <a class="btn btn-info" href="{{ route('facturas.create') }}">Crear Nueva Factura</a>
                            
                                <select id="select-ano" class="btn btn-outline-secondary float-right mb-3">
                                    <option disabled selected>Seleccione un año</option>
                                    <option class="dropdown-item" value="2021">2021</option>
                                    <option class="dropdown-item" value="2022">2022</option>
                                    <option class="dropdown-item" value="2023">2023</option>
                                </select>
                                
                            <table class="table table-stripped mt-3" id="listado_facturas">
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
                                        <td>{{$factura->estado}}</td>

                                        <td>
                                        <a href="{{ route('facturas.pdf',$factura->id_factura) }}" class="btn btn-success" >Detalles Factura</a>
                                        <form action="{{ route('facturas.destroy',$factura->id_factura) }}" method="POST" class="formulario-eliminar" style="display: inline;">
                                            @csrf

                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Eliminar</button>

                                        </form>
                                    </td>
                                    </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination justify-content-end">
                                {!! $facturas->links() !!}
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
<link href="{{ asset('assets/css/sweetalert2.min.css') }}" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
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

 <script>
 $('#listado_facturas').dataTable({
    "bInfo": true, // hide showing entries

});

 </script>   
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
