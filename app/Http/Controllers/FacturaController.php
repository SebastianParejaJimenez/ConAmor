<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Factura;
use Illuminate\Support\Facades\DB;
use App\Models\Producto;
use App\Models\Cliente;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FacturaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $rol = Auth::user()->rol_id;

        $usuario = Auth::user()->name;
        $facturas = DB::table('facturas')
        ->select('id_factura', 'total' ,'facturas.created_at', 'clientes.nombre_cliente', 'facturas.estado')
        ->join('clientes', 'facturas.cliente_id', '=', 'clientes.id_cliente')
        ->orderBy('id_factura','ASC')
        ->where('facturas.estado', '=', 'activo')
        ->paginate();

        return view('facturas.index', compact('facturas', 'usuario', 'rol'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rol = Auth::user()->rol_id;

        $clientes = Cliente::all();
        $productos = Producto::all();
        return view('facturas.crear', compact('productos', 'clientes', 'rol'));
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        request()->validate([
            'total' => 'required',
            'cantidad' => 'required',
            'total' => 'required',
            'cliente_id'=>'required',
        ]);

        Factura::create($request->all());
        $id_factura = Factura::max('id_factura');
        $total = $request->total_cantidad;
        $producto = $request->producto;
        $cantidad = $request->cantidad;
        /*         $precio = $request->precio;
 */
        $cliente = $request->cliente_id;

        for ($i = 0; $i<count($cantidad); $i++) {
            $datasave = [
                'producto_id' => $producto[$i],
                'total_producto' => $total[$i],
                'cantidad' => $cantidad[$i],
                'factura_id' => $id_factura
            ];


            DB::table('productos_facturas')->insert($datasave);
        }
        // return redirect('/articulos');
        return redirect()->route('facturas.index')->with('creado','ok');

    }
    public function getProductPrice(Request $request, $id_producto)
    {
        $product = Producto::find($id_producto);

        if ($product) {
            return response()->json(['precio' => $product->precio]);
        } else {
            return response()->json(['error' => 'Product not found']);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $resultados = Factura::select('id_factura', 'estado')->where('id_factura',$id);
            # code...
            DB::table('facturas')
            ->select('estado')
            ->where('id_factura','=',$id)
            ->update(['estado'=>'eliminado']);
        return redirect()->route('facturas.index')->with('eliminado','ok');

    
    }

    public function pdf($id)
    {
        $factura_all = DB::table('productos_facturas')
        ->select('id_factura', 'producto_id', 'productos.nombre', 'productos.precio', 'cantidad','total_producto','factura_id', 'total' ,'facturas.created_at')
        ->join('facturas', 'productos_facturas.factura_id', '=', 'facturas.id_factura')
        ->join('productos', 'productos_facturas.producto_id', '=', 'productos.id_producto')
        ->where('factura_id', $id)
        ->get();

        $id_c = DB::table('facturas')
        ->select('cliente_id')
        ->where('id_factura', $id)
        ->pluck('cliente_id');

        $factura_cliente = DB::table('facturas')
        ->select('id_factura', 'clientes.nombre_cliente', 'clientes.documento_identidad')
        ->join('clientes', 'facturas.cliente_id', '=', 'clientes.id_cliente')
        ->where('clientes.id_cliente', $id_c)
        ->get();

        $f = Factura::all();
        $pdf = Pdf::loadView('facturas.pdf', compact('factura_all', 'factura_cliente'));
        return $pdf->stream();
    }
}
