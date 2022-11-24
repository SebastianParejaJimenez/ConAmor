@extends('layouts.app')
@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet"
        href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
@endpush
@section('content')
@php
use App\Models\User;
$cant_usuarios = User::count();    
use App\Models\Proveedor;
$cant_prov = Proveedor::count();   
use App\Models\Producto;
$cant_prod = Producto::count();                                              
@endphp

    <section class="section">
            <div class="section-header">
                <h1>Menu Principal</h1>
            </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">                          
                                <div class="row">
                                
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-info">
                            <i class="far fa-user"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Usuarios</h4>
                            </div>
                            <div class="card-body">
                            {{$cant_usuarios}}
                            </div>
                            <a href="/proveedores" ><i class="fa fa-share mr-2" aria-hidden="true"></i>Ver más</a>
                        </div>
                    </div>
                </div>
                                                                            
                                    
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="fas fa-truck"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Proveedores</h4>
                            </div>
                            <div class="card-body">
                                {{$cant_prov}}

                            </div>
                            <a href="/proveedores" ><i class="fa fa-share mr-2" aria-hidden="true"></i>Ver más</a>

                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="fas fa-archive"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Productos</h4>
                            </div>
                            <div class="card-body">
                            {{$cant_prod}}

                            </div>
                            <a href="/proveedores" ><i class="fa fa-share mr-2" aria-hidden="true"></i>Ver más</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="far fa-file"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Documentos</h4>
                            </div>
                            <div class="card-body">
                                0   
                            </div>
                            <a href="/proveedores" ><i class="fa fa-share mr-2" aria-hidden="true"></i>Ver más</a>
                        </div>
                    </div>
                </div>
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Molestias ullam accusantium inventore cumque id nulla amet exercitationem voluptate numquam sunt, impedit explicabo officia delectus. Expedita odit vitae incidunt laboriosam eligendi.
                            Repellendus iusto porro amet mollitia unde eaque cupiditate eius commodi eveniet illo deserunt voluptates nisi placeat ex omnis inventore sunt, fuga, cumque facilis laborum fugit. Adipisci eveniet inventore libero hic.
                            Molestiae, iure veniam non ipsa hic nulla atque! Quae, dolorum possimus. Laborum ipsum rerum natus similique, perferendis tempora a rem. Nihil commodi ipsa culpa similique architecto quod placeat voluptas excepturi.
                            Excepturi numquam ducimus aspernatur totam quisquam, voluptatem voluptatum ea omnis nobis ratione. Magni non adipisci nulla cupiditate repellat temporibus? Earum quidem nostrum quia ipsam dolorem cumque harum pariatur numquam odit!
                            Pariatur natus non quasi earum reiciendis laborum repellendus odio quam saepe molestiae similique reprehenderit laboriosam, nesciunt dicta ipsum modi quaerat ea aliquid rerum magnam id doloremque placeat nostrum veniam? Eligendi!
                            Cum esse dicta accusantium ipsum alias magni! Cumque suscipit nihil quisquam dolorum maxime explicabo incidunt atque fugit, officia dolorem, vel autem sequi repellendus vitae odit est perspiciatis necessitatibus pariatur delectus?
                            Similique quaerat quae nostrum dolores! Illo vel ut est atque suscipit dolor eligendi facilis. Consequuntur ad hic neque animi excepturi tempora sed dolore quo distinctio sunt? Possimus doloremque velit qui.
                            Numquam quibusdam suscipit facilis unde culpa quam vero iste et doloremque, ea voluptate libero! Ullam laboriosam, esse id tempore, suscipit mollitia repellendus, soluta nulla possimus quis nemo pariatur cum culpa!
                            Nam assumenda molestiae libero iusto non earum laborum eaque nobis dignissimos. Incidunt expedita ea cumque? Nam officia cum corrupti praesentium commodi facere quos, ad assumenda beatae quidem rerum soluta quibusdam.
                            Illo, laudantium. Aspernatur sed mollitia ratione minima quo fuga impedit voluptatem error aliquid nobis, in incidunt labore provident totam exercitationem quia harum dolore distinctio odit fugit? Ullam rem corrupti quam?
                        </div>                            
                    </div>                            
                </div>                            
            </div>                            
        </div>
    </section>
@endsection
@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/simpleweather/jquery.simpleWeather.min.js') }}"></script>
    <script src="{{ asset('library/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('library/summernote/dist/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/index-0.js') }}"></script>
@endpush
