@extends('layouts.app')

@section('content')
    <section class="section">
    <div class="section-header">
            <h1>Crear</h1>
          </div>
        <div class="section-body">
            
        <h2 class="section-title">Formulario para Crear</h2>
            <p class="section-lead">El siguiente formulario le permitira crear el Rol a desear.</p>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
<!--                         Para atrapar errores y mostrarlos
 -->                    @if($errors->any())
                        <div class="alert " role="alert">
                            @foreach($errors->all() as $error)
                            <button type="button" data-dismiss="alert" arial-label="Close"
                                        class="btn btn-primary btn-icon icon-left">
                                        <i class="fas fa-eye"></i> Error: <span
                                            class="badge badge-transparent">{{$error}}</span>
                            </button>

                            @endforeach

                        </div>
                        @endif


                        {!! Form::open(array("route"=>"roles.store", "method"=>"POST"))!!}
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="name">Nombre</label>
                                    {!! Form::text('nombre', null, array('class'=>'form-control')) !!}
                                </div>
                            </div>                        


                        </div>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <a href="/roles" class="btn btn-secondary">Cancelar</a>

                        {!! Form::close()!!}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

