@extends('layouts.app')
@section('title')
Clientes
@endsection
@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Clientes</h3>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <a class="btn btn-info mb-3" href="{{ route('clientes.create') }}">Agregar Nuevo Cliente</a>
                        @if($rol===1)

                        <a class="btn btn-warning mb-3" href="{{ route('clientes.inactivo') }}">Clientes Inactivos</a>

                        @endif
                    <div class="table-responsive">   
                        <table class="table table-stripped mt-2" id="listado">
                            <thead>
                                <th>Nombre</th>
                                <th>Documento de Identidad</th>
                                <th>Hora de Creacion</th>
                                <th>Estado</th>
                                @if($rol===1)

                                <th>Acciones</th>
                                @endif
                            </thead>
                            <tbody>
                                @foreach($clientes as $cliente)
                                <tr>
                                    <td>{{$cliente->nombre_cliente}}</td>
                                    <td>{{$cliente->documento_identidad}}</td>
                                    <td>
                                        <span class="badge badge-pill badge-light">{{ \Carbon\Carbon::parse($cliente->created_at)->formatLocalized('%d %B %Y %I:%M %p');}}</span>
                                    </td>
                                    <td>
                                    <span class="badge badge-pill badge-success">ACTIVO</span>
                                    </td>

                                    @if($rol===1)

                                    <td>

                                        <a href="{{ route('clientes.edit',$cliente->id_cliente) }}" class="btn btn-info">Editar</a>
                                        
                                        <form action="{{ route('clientes.destroy',$cliente->id_cliente) }}" method="POST" class="formulario-eliminar" style="display: inline;">
                                            @csrf

                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Inhabilitar</button>

                                        </form>

                                    </td>
                                    @endif
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
</section>
@endsection

@section('scripts')
<script src="{{ asset('assets/js/sweetalert2.all.min.js') }}"></script>
<link href="{{ asset('assets/css/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
@if(session('eliminado')== "ok")
<script>
    Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'Inhabilitado con Exito!',
        showConfirmButton: false,
        timer: 900
    })
</script>
@endif
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

@if(session('error')== "cliente_inactivo")
<script>
    Swal.fire({
        position: 'top-end',
        icon: 'error',
        title: 'El cliente ya esta inactivo.',
        showConfirmButton: false,
        timer: 5000
    })
</script>
@endif


<script>
    $('.formulario-eliminar').submit(function(e) {
        e.preventDefault();

        Swal.fire({
            title: 'Estas Seguro de Inhabilitar el Cliente?',
            text: "Lo podras recuperar en el apartado de Clientes Inactivos.",
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