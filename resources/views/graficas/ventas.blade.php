@extends('layouts.app')

@section('content')

<!-- Agrega los archivos necesarios de Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Crea un elemento canvas donde se dibujará la gráfica -->

<section class="section">

    <div class="section-header">
        <div class="section-body">
                    <h2 class="section-title">Ganancias Mensuales Del Año <b>{{$ano}}</b></h2>
                    <p class="section-lead">La siguiente grafica representara las ganancias generadas durante todos los meses del año.</p>
        
        </div>

    </div>
    <div class="section-body">

        </div>

         <section class="section">

                <div class="row">
                    <div class="col-lg-12">
                            <div class="card-body">
                                <div class="card">
                                    <div class="card-body">
                                    <canvas id="graficaVentas"></canvas>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div> 
    
        </section> 
<script>                                   

// Obtén los datos de ventas y las etiquetas de los meses desde el controlador
var ventas = {!! json_encode($ventas) !!};
var labels = {!! json_encode($labels) !!};

// Crea una instancia de Chart.js y configura la gráfica
var ctx = document.getElementById('graficaVentas').getContext('2d');
var chart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: 'Ventas',
            data: ventas,
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>
@endsection
