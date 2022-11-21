@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
<!--                         Para atrapar errores y mostrarlos
 -->                    @if($errors->any())
                        <div class="alert alert-dark alert-dimissible fade show" role="alert">
                            <strong>Revise los Campos! <span class="badge badge-light">@php$cant_error = $errors->count();@endphp</span> </strong>
                            @foreach($errors->all() as $error)
                            <span class="badge badge-danger">{{ $error}}</span>
                            <button class="close" data-dismiss="alert" arial-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            @endforeach

                        </div>
                        @endif


                        <form action="{{ route('blogs.store') }}" method="POST">
                            @csrf
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="name">Titulo</label>
                                    <input type="text" name="titulo" class="form-control">
                                </div>
                            </div>
                        
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="name">Contenido</label>
                                    <input type="text" name="contenido" class="form-control">
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </div>
                        </form>
                        

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

