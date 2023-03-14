@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <!--                         Para atrapar errores y mostrarlos
 -->                     @if($errors->any())
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

                                        <input name="documento" id="documento" type='file' class="hidden" accept=".pdf, .txt, .docx, .jpg, .xls" />
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                    <a href="/documentos" class="btn btn-secondary">Cancelar</a>
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