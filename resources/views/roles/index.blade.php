@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Roles</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            @can('crear-rol')
                            <a class="btn btn-info" href="{{ route('roles.create') }}">Añadir Nuevo Rol</a>
                            @endcan

                            <table class="table table-stripped mt-2">
                                <thead>
                                    <th>ROL</th>
                                    <th>ACCIONES</th>
                                </thead>
                                <tbody>
                                @foreach($roles as $role)
                                    <tr>
                                        <td>{{$role->nombre}}</td>
                                        <td>
                                            @can('editar-rol')
                                            <a class="btn btn-info" href="{{route('roles.edit', $role->id)}}">Editar</a>
                                            @endcan

                                            @can('borrar-rol')
                                            <!-- Formulario con html collective (Laravel) -->
                                            <form action="{{ route('roles.destroy',$role->id) }}" method="POST" class="formulario-eliminar" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Borrar</button>

                                            </form>
                                            @endcan

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination justify-content-end">
                                {!! $roles->links() !!}
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
  title: 'Estas Seguro de Eliminar el ROL?',
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