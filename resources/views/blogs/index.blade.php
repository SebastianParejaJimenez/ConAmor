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
                            @can('crear-blog')
                            <a class="btn btn-info" href="{{ route('blogs.create') }}">Nuevo Blog</a>
                            @endcan

                            <table class="table table-stripped mt-2">
                                <thead>
                                    <th>ID</th>
                                    <th>TITULO</th>
                                    <th>CONTENIDO</th>
                                    <th>ACCIONES</th>
                                </thead>
                                <tbody>
                                @foreach($blogs as $blog)
                                    <tr>
                                        <td>{{$blog->id}}</td>
                                        <td>{{$blog->titulo}}</td>
                                        <td>{{$blog->contenido}}</td>

                                        <td>
                                            <!-- Formulario con html collective (Laravel) -->
                                            <form action="{{ route('blogs.destroy',$blog->id) }}" method="POST">
                                                @can('editar-blog')
                                                <a href="{{ route('blogs.edit',$blog->id) }}" class="btn btn-info">Editar</a>
                                                @endcan
                                                @csrf

                                                @method('DELETE')
                                                @can('borrar-blog')
                                                <button type="submit" class="btn btn-danger">Borrar</button>
                                                @endcan

                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination justify-content-end">
                                {!! $blogs->links() !!}
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

