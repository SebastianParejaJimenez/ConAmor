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
                            <a class="btn btn-info" href="{{ route('usuarios.create') }}">Agregar Nuevo Usuario</a>
                            <table class="table table-stripped mt-2">
                                <thead>
                                    <th>ID</th>
                                    <th>NOMBRES</th>
                                    <th>EMAIL</th>
                                    <th>ROL</th>
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
                                        <td>{{$usuario->nombre}}</td>
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
                            <div class="pagination justify-content-end">
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
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<link href="{{ asset('assets/css/sweetalert2.min.css') }}" rel="stylesheet" type="text/css"/>

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

@endsection