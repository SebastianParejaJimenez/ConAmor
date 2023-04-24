<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Factura;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class GraficasController extends Controller
{
    //
    public function ventas(Request $request, $ano)
    {
/*         // Obtiene el año seleccionado del request o el año actual si no se seleccionó uno.
        $ano = $request->segment(3); */
        // Obtener el rol del usuario.

        $rol = Auth::user()->rol_id;

        // Obtiene los datos de ventas del año seleccionado.
        $ventas = Factura::obtenerDatos($ano);

        // Obtiene las etiquetas de los meses del año.
        $labels = Factura::obtenerLabels();
    
        return view('graficas.ventas', ['ventas' => $ventas, 'labels' => $labels, 'ano' => $ano, 'rol' => $rol]);
    }
    


}
