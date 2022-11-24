@extends('layouts.app')

@section('content')
    <section class="section">
    <div class="section-header">
            <h1>Editar</h1>
          </div>
        <div class="section-body">
            
        <h2 class="section-title">Formulario para Editar</h2>
            <p class="section-lead">El siguiente formulario le permitira editar el Producto seleccionado.</p> 
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


                        <form action="{{ route('proveedores.update', $proveedor->id_proveedor)}}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" value="{{$proveedor->user_id}}" name="user_id">

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="name">Nombre</label>
                                    <input type="text" name="nombre" class="form-control" value="{{$proveedor->nombre}}">
                                </div>
                            </div>
                        
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="name">Telefono</label>
                                    <input type="text" name="telefono" class="form-control" value="{{$proveedor->telefono}}">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="name">Correo del Proveedor</label>
                                    <input type="email" name="correo" class="form-control" value="{{$proveedor->correo}}">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="name">Direccion</label>
                                    <input type="text" name="direccion" class="form-control" value="{{$proveedor->direccion}}">
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                <a href="/proveedores" class="btn btn-secondary">Cancelar</a>
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

