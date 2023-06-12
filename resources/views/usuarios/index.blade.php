@extends('layouts.app')

@section('content')


    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Usuarios</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                        @if($rol===1)

                            <a class="btn btn-info mb-3" href="{{ route('usuarios.create') }}">Agregar Nuevo Usuario</a>
                        @endif
                        <div class="table-responsive">   
                            <table class="table table-stripped mt-2" id="listado">
                                <thead>
                                    <th>ID</th>
                                    <th>NOMBRES</th>
                                    <th>EMAIL</th>
                                    <th>ROL</th>
                                    <th>Hora de Creacion</th>
                                    @if ($rol===1)  
                                    <th>ACCIONES</th>
                                    @endif

                                     
                                </thead>
                                <tbody>
                                    @foreach($usuarios as $usuario)
                                    <tr>
                                        <td>{{$usuario->id}}</td>
                                        <td>{{$usuario->name}}</td>
                                        <td>{{$usuario->email}}</td>
                                        <td>
                                            <span class="badge badge-pill badge-primary">{{$usuario->nombre}}</span>
                                        </td>
                                        <td>
                                        <span class="badge badge-pill badge-light">{{ \Carbon\Carbon::parse($usuario->created_at)->formatLocalized('%d %B %Y %I:%M %p');}}</span>
                                        </td>
                                        @if($rol===1)
                                        <td>
                                            <a class="btn btn-info" href="{{route('usuarios.edit', $usuario->id)}}">Editar</a>
                                            <!-- Formulario con html collective (Laravel) -->
                                            {!! Form::open(['method'=>'DELETE','class'=>'formulario-eliminar' ,'route'=>['usuarios.destroy',$usuario->id], 'style'=>'display:inline']) !!} 
                                                {!! Form::submit('Borrar', ['class'=>'btn btn-danger'])!!}
                                            {!! Form::close() !!}

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
@if(session('error')== "usuario_datos_creados")
<script>
Swal.fire({
  icon: 'error',
    title: 'Parece que algo anda mal',
  text: '¡Este usuario ha creado algo en el sistema, debe ser eliminado para que este usuario se pueda eliminar!',
})
</script>
@endif
<script>

$('.formulario-eliminar').submit(function(e){
e.preventDefault();

Swal.fire({
  title: '¿Estas Seguro de Eliminar este Usuario?',
  text: "No podras recuperarlo si lo eliminas.",
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