@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Productos</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                        @if($rol===1)
                        <a class="btn btn-info mb-3" href="{{ route('productos.create') }}">Agregar Nuevo Producto</a>
                        <a class="btn btn-warning mb-3 " href="{{ route('productos.inactivo') }}">Productos Inactivos</a>
                        @endif
                        
                        <div class="table-responsive">   
                            <table class="table table-stripped mt-2 " id="listado">
                                <thead>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Tipos</th>
                                    <th>Precio</th>
                                    <th>Creado por</th>
                                    <th>Estado</th>
                                    <th>Hora de Creacion</th>
                                    @if ($rol===1)  
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
                                            <span class="badge badge-pill badge-success">ACTIVO</span>
                                        </td>
                                        <td>
                                        <span class="badge badge-pill badge-light">{{ \Carbon\Carbon::parse($producto->created_at)->formatLocalized('%d %B %Y %I:%M %p');}}</span>
                                        </td>
                                        @if($rol===1)

                                        <td>
                                        <a href="{{ route('productos.edit',$producto->id_producto)  }}" class="btn btn-info" >Editar</a>
                                        <form action="{{ route('productos.destroy',$producto->id_producto) }}" method="POST" class="formulario-eliminar" style="display: inline;">

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
<link href="{{ asset('assets/css/sweetalert2.min.css') }}" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
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

<!-- Scripts para Confirmaciones
 -->
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

@if(session('editado')== "ok")
<script>
    Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'Editado con Exito!',
        showConfirmButton: false,
        timer: 1000
    })
</script>
@endif

@if(session('error')== "pruducto_inactivo")
<script>
    Swal.fire({
        position: 'top-end',
        icon: 'error',
        title: 'El producto ya esta inactivo.',
        showConfirmButton: false,
        timer: 5000
    })
</script>
@endif



<script>
    $('.formulario-eliminar').submit(function(e) {
        e.preventDefault();

        Swal.fire({
            title: 'Estas Seguro de Inhabilitar el Producto?',
            text: 'Podras recuperarlo si vas a el apartado de "Productos Inhabilitados".',
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
    responsive: true,
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
