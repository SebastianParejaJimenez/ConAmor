<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


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
        $mes_actual = strtoupper(Carbon::now()->monthName);
        $mes_numeros = Carbon::now()->month;


        $fecha_inicio = Carbon::now()->startOfMonth();
        $fecha_fin = Carbon::now()->endOfMonth();
        $facturas = Factura::where('estado', 'ACTIVO')
            ->whereBetween('created_at', [$fecha_inicio, $fecha_fin])
            ->groupBy('fecha')
            ->selectRaw('SUM(total) as total, DATE(created_at) as fecha')
            ->get();
            $ventas = $facturas->pluck('total');
            $labels = $facturas->pluck('fecha')->map(function ($fecha) {
            return Carbon::parse($fecha)->format('d \d\e M \d\e Y');
        });

        $total_mensual_actual = DB::table('facturas')
        ->select(DB::raw('SUM(total) as total_mes'))
        ->whereMonth('created_at', Carbon::now()->month)
        ->where('estado', '=', 'activo')
        ->pluck('total_mes')
        ->first();

        $rol = Auth::user()->rol_id;
        
        return view('home', compact('rol', 'labels', 'ventas', 'mes_actual' , 'total_mensual_actual'));
        }
    }
