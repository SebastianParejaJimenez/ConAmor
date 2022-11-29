@extends('layouts.app')

@section('content')
    <section class="section">
    <div class="section-header">
            <h1>Editar</h1>
          </div>
        <div class="section-body">
            
        <h2 class="section-title">Formulario para Editar</h2>
            <p class="section-lead">El siguiente formulario le permitira editar el Cliente seleccionado.</p> 
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
<!--                         Para atrapar errores y mostrarlos
 -->                    @if($errors->any())
                        <div class="alert alert-dark alert-dimissible fade show" role="alert">
                            <strong>Revise los Campos!</strong>
                            @foreach($errors->all() as $error)
                            <span class="badge badge-danger">{{$error}}</span>
                            <button class="close" data-dismiss="alert" arial-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            @endforeach

                        </div>
                        @endif


                        <form action="{{ route('clientes.update', $cliente->id_cliente)}}" method="POST">
                            @csrf
                            @method('PUT')
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="name">Nombre del Cliente</label>
                                    <input type="text" name="nombre_cliente" class="form-control" value="{{$cliente->nombre_cliente}}">
                                </div>
                            </div>
                        
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="name">Documento de Identidad</label>
                                    <input type="number" name="documento_identidad" class="form-control" value="{{$cliente->documento_identidad}}">
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                <a href="/clientes" class="btn btn-secondary">Cancelar</a>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

