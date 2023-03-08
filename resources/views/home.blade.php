@extends('layouts.app')
@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
@endpush
@section('content')
@php
use App\Models\Cliente;
$cant_cliente = Cliente::count();
use App\Models\User;
$cant_usuarios = User::count();
use App\Models\Proveedor;
$cant_prov = Proveedor::count();
use App\Models\Producto;
$cant_prod = Producto::count();
use App\Models\Documento;
$cant_docs = Documento::count();
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
                                        <a href="/usuarios"><i class="fa fa-share mr-2" aria-hidden="true"></i>Ver más</a>
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
                                        <a href="/proveedores"><i class="fa fa-share mr-2" aria-hidden="true"></i>Ver más</a>

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
                                        <a href="/productos"><i class="fa fa-share mr-2" aria-hidden="true"></i>Ver más</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                <div class="card card-statistic-1">
                                    <div class="card-icon bg-primary">
                                        <i class="fas fa-users"></i>
                                    </div>
                                    <div class="card-wrap">
                                        <div class="card-header">
                                            <h4>Clientes</h4>
                                        </div>
                                        <div class="card-body">
                                            {{$cant_cliente}}
                                        </div>
                                        <a href="/clientes"><i class="fa fa-share mr-2" aria-hidden="true"></i>Ver más</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section class="section">
            <div class="section-body">
                <h2 class="section-title">Ganancias Mensuales</h2>
                <p class="section-lead">La siguiente grafica representara las ganancias generadas mensuales.</p>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="card">
                                    <div class="card-body">
                                        <h1>{{ $chart->options['chart_title'] }}</h1>
                                        {!! $chart->renderHtml() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

        @endsection
        @section('scripts')
        {!! $chart->renderHtml() !!}
        {!! $chart->renderChartJsLibrary() !!}
        {!! $chart->renderJs() !!}
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