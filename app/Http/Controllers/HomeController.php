<?php

namespace App\Http\Controllers;

use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $chart_options = [
            'chart_title' => 'Control Mensual',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Factura',
            'group_by_field' => 'created_at',
            'group_by_period' => 'day',
            'chart_type' => 'line',
            'chart_color' => '103, 119, 239',
            'aggregate_function' => 'sum',
            'aggregate_field' => 'total',
             'continuous_time' => true,
             'filter_field ' => 'created_at',
        ];
        $chart = new LaravelChart($chart_options);
        
        $rol = Auth::user()->rol_id;
        return view('home', compact('rol', 'chart'));
    }
}
