@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                    <h2 class="section-title">Formulario para Crear </h2>
            <p class="section-lead">El siguiente formulario le permitira Registrar Documentos.</p>   
                        <!--                         Para atrapar errores y mostrarlos-->                     
                        @if($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <h4 class="alert-heading">¡Ups! Se encontraron algunos errores:</h4>
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif




                        <form enctype="multipart/form-data" action="{{ route('documentos.store') }}" method="POST">
                            @csrf
                            <input type="hidden" value="{{$user}}" name="user_id">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="name">Nombre del Documento</label>
                                        <input type="text" name="nombre" class="form-control">
                                    </div>
                                </div>

                                <div class="card-header">
                                    <h4>Subir Documento</h4>
                                </div>
               <div class="grid grid-cols-1 mt-5 mx-7">
                    <img id="docSeleccionada" style="max-height: 300px;">           
                </div>
                                <div class="card-body col-xs-12 col-sm-12 col-md-12">
                                    <div class="jumbotron text-center">
                                        <h2>Seleccionar Documento</h2>
                                        <p><b>Solo se PERMITEN</b> documentos tipo<strong> PDF y TXT</strong>.</p>
                                        <input name="documento" id="documento" type='file' class="hidden" accept=".pdf, .txt" />
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                    <a href="{{ url('/documentos') }}" class="btn btn-secondary">Cancelar</a>
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
@section('js')
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script>
    $(document).ready(function(e) {
        $('#documento').change(function() {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#docSeleccionada').attr('src'.e,target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });
    });
</script>

@endsection