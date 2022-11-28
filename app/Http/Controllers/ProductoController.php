<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Producto;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rol = Auth::user()->rol_id;

        $productos = DB::table('productos')
        ->select('id_producto', 'nombre','tipo','precio', 'productos.created_at', 'name')
        ->join('users', 'productos.user_id', '=', 'users.id')
        ->paginate(5);
        $productos5=Producto::paginate(5);
        return view('productos.index', compact('productos','rol'));
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        
        $rol = Auth::user()->rol_id;
        $user = Auth::user()->id;
        return view('productos.crear', compact('user'));
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
            'nombre'=>'required',
            'tipo'=>'required',
            'precio'=>'required',
            'user_id'=>'required'
        ]);

        Producto::create($request->all());
        return redirect()->route('productos.index')->with('creado','ok');
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
        $objetoproducto = Producto::findOrFail($id);
        return view('productos.index', compact('objetoproducto'));
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
        $producto=Producto::find($id);
        return view('productos.editar', compact('producto'));
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
        request()->validate([
            'nombre'=>'required',
            'tipo'=>'required',
            'precio'=>'required',
            'user_id'=>'required'
        ]);
        $producto=Producto::find($id);
        $producto->update($request->all());
        return redirect()->route('productos.index');

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
        Producto::find($id)->delete();
        return redirect()->route('productos.index')->with('eliminado','ok');
    }
}
