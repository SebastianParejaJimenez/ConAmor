<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Factura extends Model
{
    protected $primaryKey = 'id_factura';
    use HasFactory;
    protected $fillable = ['total', 'cliente_id','estado'];



    protected $table = 'facturas';

    /**
     * Función que obtiene los datos de ventas del año seleccionado.
     *
     * @param  int  $ano
     * @return array
     */
    public static function obtenerDatos($ano)
    {
                $ventas = Factura::whereYear('created_at', $ano)
                ->selectRaw('SUM(total) as total, MONTH(created_at) as mes')
                ->groupBy('mes')
                ->where('estado', '=', 'activo')
                ->get();
        $datos = array_fill(0, 12, 0);
        foreach ($ventas as $venta) {
        $mes = $venta->mes;
        $datos[$mes - 1] = $venta->total;
        }

        return $datos;
    }

    /**
     * Función que obtiene las etiquetas de los meses del año.
     *
     * @return array
     */
    public static function obtenerLabels()
    {
        $meses = [
            'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
            'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
        ];

        $labels = [];
        foreach ($meses as $mes) {
            $labels[] = $mes;
        }

        return $labels;
    
}
}
