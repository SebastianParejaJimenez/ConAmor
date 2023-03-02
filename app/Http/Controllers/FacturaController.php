<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Factura;
use Illuminate\Support\Facades\DB;
use App\Models\Producto;
use App\Models\Cliente;
use Illuminate\Support\Facades\Auth;

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
        $usuario = Auth::user()->name;
        $facturas = Factura::paginate(10);

        $factura_all = DB::table('productos_facturas')
        ->select('id_factura', 'producto_id', 'productos.nombre', 'productos.precio', 'cantidad','total_producto','factura_id', 'total','clientes.nombre_cliente' ,'facturas.created_at')
        ->join('facturas', 'productos_facturas.factura_id', '=', 'facturas.id_factura')
        ->join('productos', 'productos_facturas.producto_id', '=', 'productos.id_producto')
        ->join('clientes', 'productos_facturas.cliente_id', '=', 'clientes.id_cliente')
        ->paginate(5);


        return view('facturas.index', compact('factura_all', 'usuario'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clientes = Cliente::all();
        $productos = Producto::all();
        return view('facturas.crear', compact('productos', 'clientes'));
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
            'total' => 'required'
        ]);

        Factura::create($request->all());
         


        $id_factura = Factura::max('id_factura');


        $total = $request->total_cantidad;
        $producto = $request->producto;
        $cantidad = $request->cantidad;
        /*         $precio = $request->precio;
 */
        $cliente = $request->cliente_id;

        for ($i = 0; $i < 2; $i++) {
            $datasave = [
                'producto_id' => $producto[$i],
                'total_producto' => $total[$i],
                'cantidad' => $cantidad[$i],
                'cliente_id' => $cliente,
                'factura_id' => $id_factura
            ];


            DB::table('productos_facturas')->insert($datasave);
        }
        // return redirect('/articulos');

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
        Factura::find($id)->delete();
        return redirect()->route('facturas.index')->with('eliminado', 'ok');
    }

    /*         public function crear(Request $request){
        //

        $producto= $request->producto;
        $cantidad = $request->cantidad;
        $precio = $request->precio;
        $total = $request->total;

        for($i=0;$i<2;$i++){
            $datasave=[
                'Codigo'=>$Codigo[$i],
                'Descripcion'=>$Descripcion[$i],
                'Cantidad'=>$Cantidad[$i],
                'Precio'=>$Precio[$i],
            ];
            // DB::table('articulos')->insert($datasave);
            }
            return dd($datasave);
            // return redirect('/articulos');
    } */
}
