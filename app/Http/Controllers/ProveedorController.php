<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proveedor;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rol = Auth::user()->rol_id;

        $proveedores = DB::table('proveedors')
        ->select('id_proveedor', 'nombre','telefono', 'direccion','correo', 'name','proveedors.created_at')
        ->join('users', 'proveedors.user_id', '=', 'users.id')
        ->get();
        $proveedores4 = Proveedor::paginate(5);
        return view('proveedores.index', compact('proveedores', 'rol'));
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
        if ($rol==1) {
            return view('proveedores.crear', compact('user', 'rol'));
        }
        return redirect()->route('proveedores.index');

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
            'nombre' => 'required|between:1,30',
            'telefono'=>'required|numeric|digits_between:1,30',
            'correo'=>'required|email',
            'direccion'=>'required',
            'user_id'=>'required'
        ]);

        Proveedor::create($request->all());
        return redirect()->route('proveedores.index')->with('creado','ok');
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
        $rol = Auth::user()->rol_id;
        $user = Auth::user()->id;
        $proveedor = Proveedor::find($id);
        if ($rol==1) {
            return view('proveedores.editar',compact('proveedor', 'rol'));
        }

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
            'nombre' => 'required|between:1,30',
            'telefono'=>'required|numeric|digits_between:1,50',
            'correo'=>'required|email',
            'direccion'=>'required',
            'user_id'=>'required'

        ]);
        $proveedor = Proveedor::find($id);

        $proveedor->update($request->all());
        return redirect()->route('proveedores.index');
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
        $rol = Auth::user()->rol_id;
        if ($rol==1) {
            Proveedor::find($id)->delete();
            return redirect()->route('proveedores.index')->with('eliminado','ok');
        }
    }
}
